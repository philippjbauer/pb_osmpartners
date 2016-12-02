<?php
namespace PhilippBauer\PbOsmpartners\Controller;

/***
 *
 * This file is part of the "OpenStreetMap Partners" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2016 Philipp Bauer <hello@philippbauer.org>, Philipp Bauer _ Freelance Webdeveloper
 *
 ***/

use \PhilippBauer\PbOsmpartners\Domain\Model\Partner;
use \PhilippBauer\PbOsmpartners\Utility\GeoSearchUtility;
use \PhilippBauer\PbSendmail\Utility\SendmailUtility;
use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * MapController
 */
class MapController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * mapRepository
     *
     * @var \PhilippBauer\PbOsmpartners\Domain\Repository\MapRepository
     * @inject
     */
    protected $mapRepository = null;

    /**
     * partnerRepository
     *
     * @var \PhilippBauer\PbOsmpartners\Domain\Repository\PartnerRepository
     * @inject
     */
    protected $partnerRepository = null;

    /**
     * List maps (not used really but the extension builder complained because it was missing)
     *
     * @return void
     */
    public function listAction()
    {
        $maps = $this->mapRepository->findAll();
        $this->view->assign('maps', $maps);
    }

    /**
     * Show the partner map
     *
     * @param \PhilippBauer\PbOsmpartners\Domain\Model\Map $map
     * @return void
     */
    public function showAction(\PhilippBauer\PbOsmpartners\Domain\Model\Map $map = null)
    {
        // Prepare the GeoSeachUtility
        $geoSearchUtility = new GeoSearchUtility;

        // Check if a map is given through the parameter
        // otherwise check if a map was selected through the plugin config
        if ($map === null) {
            if (empty($this->settings['mapUid'])) {
                $this->addFlashMessage('Please select a map in the plugin configuration.', 'No map found', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
                return false;
            } else {
                $map = $this->mapRepository->findByUid($this->settings['mapUid']);
            }
        }

        // Get partners from map and write data into
        // an array for later JSON conversion        
        $partners = [];
        foreach ($map->getPartners() as $partner) {
            // Check if partners have coordinates set
            // if not, lookup and persist coordinates
            if (empty($partner->getLatitude()) === true || empty($partner->getLongitude()) === true) {
                $lookupJson = $geoSearchUtility->forwardLookup($partner);
                $lookupArray = json_decode($lookupJson);
                $lookupObject = $lookupArray[0];

                $partner->setLatitude($lookupObject->lat);
                $partner->setLongitude($lookupObject->lon);

                $this->partnerRepository->update($partner);
            }

            // New partner array entry
            $partners[] = [
                'uid' => $partner->getUid(),
                'name' => $partner->getName(),
                'street' => $partner->getStreet(),
                'houseno' => $partner->getHouseno(),
                'zip' => $partner->getZip(),
                'city' => $partner->getCity(),
                'state' => $partner->getState(),
                'country' => $partner->getCountry()->getShortNameEn(),
                'url' => $partner->getUrl(),
                'logo' => $partner->getLogo(),
                'summary' => $partner->getSummary(),
                'description' => $partner->getDescription(),
                'extra' => $partner->getExtra(),
                'longitude' => $partner->getLongitude(),
                'latitude' => $partner->getLatitude(),
            ];
        }
        $partnersJson = json_encode($partners);


        $this->view->assignMultiple(compact('map', 'partnersJson'));
    }

    /**
     * Track a click on a partner link
     * 
     * @param  Partner|null $partner
     * @return void Render JSON view
     */
    public function trackingAction(Partner $partner = null)
    {
        if ($partner !== null) {
            // Increment click counter on partner
            $currentCount = $this->incrementClickCounter($partner);

            // Send email to NOX that the link was clicked
            if ($this->sendTrackingInfoMail($partner) === true) {
                $result = [
                    'success' => true,
                    'message' => 'Info mail was sent. Click was tracked.',
                    // 'counter' => $currentCount, <-- was only used to check if persistence works, shouldn't be public though
                ];
            } else {
                $result = [
                    'success' => false,
                    'message' => 'Couldn\'t send info mail. Click was tracked.',
                    // 'counter' => $currentCount, <-- was only used to check if persistence works, shouldn't be public though
                ];
            }
        } else {
            $result = [
                'success' => false,
                'message' => 'Couldn\'t find partner, abort.',
            ];
        }

        // Set headers to server JSON data
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        // Return result
        echo json_encode($result);
        exit;
    }

    /**
     * Increment the counter of the specified partner and persist the record
     * 
     * @param  Partner|null $partner
     * @return mixed
     */
    private function incrementClickCounter(Partner $partner = null)
    {
        if ($partner !== null) {
            $persistenceManager = $this->objectManager->get('\\TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
            $partner->setClickCounter((int) $partner->getClickCounter() + 1);
            $this->partnerRepository->update($partner);
            $persistenceManager->persistAll();
            
            return $partner->getClickCounter();
        }

        return false;
    }

    /**
     * Send a short info mail to the specified recipient
     * 
     * @param  Partner|null $partner
     * @return boolean
     */
    private function sendTrackingInfoMail(Partner $partner = null)
    {
        // Check for sender and recipient entries
        if (   empty($this->settings['senderName']) === true 
            || empty($this->settings['senderEmail']) === true 
            || empty($this->settings['recipientName']) === true 
            || empty($this->settings['recipientEmail']) === true) {
            return false;
        }

        $extKey = $this->request->getControllerExtensionKey();
        $extName = $this->request->getControllerExtensionName();

        // Create new Sendmail instance
        $sendmail = new SendmailUtility($extKey);

        // Configure Sendmail instance
        $sendmail
            ->setFrom([$this->settings['senderEmail'] => $this->settings['senderName']])
            ->setTo([$this->settings['recipientEmail'] => $this->settings['recipientName']])
            ->setSubject(sprintf(LocalizationUtility::translate('mail.tracking-subject', $extName), $partner->getName()))
            ->setContent(sprintf(LocalizationUtility::translate('mail.tracking-content', $extName), $partner->getName(), $partner->getClickCounter()));
        
        // Send a simple text-only mail
        try {
            return $sendmail->sendSimpleMail();        
        } catch (\Exception $e) {
            return false;
        }
    }
}
