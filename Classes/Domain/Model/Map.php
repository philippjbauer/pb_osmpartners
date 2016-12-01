<?php
namespace PhilippBauer\PbOsmpartners\Domain\Model;

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

/**
 * Map
 */
class Map extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Center Point Latitude
     *
     * @var float
     * @validate NotEmpty
     */
    protected $latitude = 0.0;

    /**
     * Center Point Longitude
     *
     * @var float
     * @validate NotEmpty
     */
    protected $longitude = 0.0;

    /**
     * partners
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PhilippBauer\PbOsmpartners\Domain\Model\Partner>
     * @cascade remove
     * @lazy
     */
    protected $partners = null;

    /**
     * name
     *
     * @var string
     * @validate NotEmpty
     */
    protected $name = '';

    /**
     * styles
     *
     * @var string
     */
    protected $styles = '';

    /**
     * Returns the latitude
     *
     * @return float $latitude
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Sets the latitude
     *
     * @param float $latitude
     * @return void
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * Returns the longitude
     *
     * @return float $longitude
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Sets the longitude
     *
     * @param float $longitude
     * @return void
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->partners = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a Partner
     *
     * @param \PhilippBauer\PbOsmpartners\Domain\Model\Partner $partner
     * @return void
     */
    public function addPartner(\PhilippBauer\PbOsmpartners\Domain\Model\Partner $partner)
    {
        $this->partners->attach($partner);
    }

    /**
     * Removes a Partner
     *
     * @param \PhilippBauer\PbOsmpartners\Domain\Model\Partner $partnerToRemove The Partner to be removed
     * @return void
     */
    public function removePartner(\PhilippBauer\PbOsmpartners\Domain\Model\Partner $partnerToRemove)
    {
        $this->partners->detach($partnerToRemove);
    }

    /**
     * Returns the partners
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PhilippBauer\PbOsmpartners\Domain\Model\Partner> $partners
     */
    public function getPartners()
    {
        return $this->partners;
    }

    /**
     * Sets the partners
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\PhilippBauer\PbOsmpartners\Domain\Model\Partner> $partners
     * @return void
     */
    public function setPartners(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $partners)
    {
        $this->partners = $partners;
    }

    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the styles
     *
     * @return string $styles
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * Sets the styles
     *
     * @param string $styles
     * @return void
     */
    public function setStyles($styles)
    {
        $this->styles = $styles;
    }
}
