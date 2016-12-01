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

use \PhilippBauer\PbOsmpartners\Utility\GeoSearchUtility;

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
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $maps = $this->mapRepository->findAll();
        $this->view->assign('maps', $maps);
    }

    /**
     * action show
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
}
