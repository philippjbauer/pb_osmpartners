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
 * Partner
 */
class Partner extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * name
     *
     * @var string
     * @validate NotEmpty
     */
    protected $name = '';

    /**
     * street
     *
     * @var string
     * @validate NotEmpty
     */
    protected $street = '';

    /**
     * houseno
     *
     * @var string
     * @validate NotEmpty
     */
    protected $houseno = '';

    /**
     * zip
     *
     * @var string
     * @validate NotEmpty
     */
    protected $zip = '';

    /**
     * city
     *
     * @var string
     * @validate NotEmpty
     */
    protected $city = '';

    /**
     * state
     *
     * @var string
     */
    protected $state = '';

    /**
     * url
     *
     * @var string
     */
    protected $url = '';

    /**
     * summary
     *
     * @var string
     */
    protected $summary = '';

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * extra
     *
     * @var string
     */
    protected $extra = '';

    /**
     * logo
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @cascade remove
     */
    protected $logo = null;

    /**
     * country
     *
     * @var \SJBR\StaticInfoTables\Domain\Model\Country
     * @lazy
     */
    protected $country = null;

    /**
     * latitude
     *
     * @var float
     */
    protected $latitude = 0.0;

    /**
     * longitude
     *
     * @var float
     */
    protected $longitude = 0.0;

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
     * Returns the street
     *
     * @return string $street
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Sets the street
     *
     * @param string $street
     * @return void
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * Returns the houseno
     *
     * @return string $houseno
     */
    public function getHouseno()
    {
        return $this->houseno;
    }

    /**
     * Sets the houseno
     *
     * @param string $houseno
     * @return void
     */
    public function setHouseno($houseno)
    {
        $this->houseno = $houseno;
    }

    /**
     * Returns the zip
     *
     * @return string $zip
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Sets the zip
     *
     * @param string $zip
     * @return void
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * Returns the city
     *
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Sets the city
     *
     * @param string $city
     * @return void
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Returns the state
     *
     * @return string $state
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Sets the state
     *
     * @param string $state
     * @return void
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Returns the url
     *
     * @return string $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the url
     *
     * @param string $url
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Returns the summary
     *
     * @return string $summary
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Sets the summary
     *
     * @param string $summary
     * @return void
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the extra
     *
     * @return string $extra
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * Sets the extra
     *
     * @param string $extra
     * @return void
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
    }

    /**
     * Returns the logo
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $logo
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Sets the logo
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $logo
     * @return void
     */
    public function setLogo(\TYPO3\CMS\Extbase\Domain\Model\FileReference $logo)
    {
        $this->logo = $logo;
    }

    /**
     * Returns the country
     *
     * @return \SJBR\StaticInfoTables\Domain\Model\Country $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Sets the country
     *
     * @param \SJBR\StaticInfoTables\Domain\Model\Country $country
     * @return void
     */
    public function setCountry(\SJBR\StaticInfoTables\Domain\Model\Country $country)
    {
        $this->country = $country;
    }

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
}
