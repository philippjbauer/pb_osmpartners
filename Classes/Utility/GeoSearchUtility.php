<?php
namespace PhilippBauer\PbOsmpartners\Utility;

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
* GeoSearchUtility for OpenStreetmap Partners Extension
*/
class GeoSearchUtility
{
	/**
	 * Provider URL
	 * @var string
	 */
	protected $provider = 'http://nominatim.openstreetmap.org/search';

	/**
	 * Result Format
	 * options: html, xml, json, jsonv2
	 * @var string
	 */
	protected $format = 'json';

	/**
	 * Result Limit
	 * @var integer
	 */
	protected $limit = 1;

	/**
	 * Remove Duplicates from Result
	 * @var integer
	 */
	protected $dedup = 1;

	/**
	 * Init GeoSerachUtility Class
	 */
	public function __construct()
	{
		// Check if cURL is enabled
		if (function_exists('curl_version') === false) {
			throw new Exception("Please enable cURL on your server to use this service.", 001);			
		}
	}

	/**
	 * forwardLookup
	 * Search for coordinates and other information on an address
	 *
	 * @param  \PhilippBauer\PbOsmpartners\Domain\Model\Partner $partner Partner whos address shall be looked up
	 * @param  array $parameters
	 * @return string
	 */
	public function forwardLookup(\PhilippBauer\PbOsmpartners\Domain\Model\Partner $partner, $parameters = null)
	{
		// Build parameter array if none is given
		if ($parameters === null) {
			$parameters = [
				'q' => implode(', ', [
					$partner->getStreet() . ' ' . $partner->getHouseno(),
					$partner->getCity(),
					$partner->getZip(),
					$partner->getState(),
					$partner->getCountry()->getShortNameEn(),
				]),
				'format' => $this->getFormat(),
				'limit' => $this->getLimit(),
				'dedup' => $this->getDedup(),
			];
		}

		// Build URL query
		$urlQuery = http_build_query($parameters);

		// Init cURL
		$curlHandler = curl_init();

		// Set cURL options
		curl_setopt_array($curlHandler, [
			CURLOPT_URL => $this->getProvider() . '?' . $urlQuery,
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_HEADER => FALSE,
		]);

		$curlResult = curl_exec($curlHandler);

		if ($curlResult === false) {
			throw new Exception(curl_error($curlHandler), curl_errno($curlHandler));
		}

		return $curlResult;
	}

	/**
	 * Set provider
	 * 
	 * @param string $provider
	 * @return self
	 */
	public function setProvider($provider)
	{
		$this->provider = $provider;

		return $this;
	}

	/**
	 * Get provider
	 * 
	 * @return string
	 */
	public function getProvider()
	{
		return $this->provider;
	}

	/**
	 * Set format
	 * 
	 * @param string $format
	 * @return self
	 */
	public function setFormat($format)
	{
		$this->format = $format;

		return $this;
	}

	/**
	 * Get format
	 * 
	 * @return string
	 */
	public function getFormat()
	{
		return $this->format;
	}

	/**
	 * Set limit
	 * 
	 * @param integer $limit
	 * @return self
	 */
	public function setLimit($limit)
	{
		$this->limit = $limit;

		return $this;
	}

	/**
	 * Get limit
	 * 
	 * @return integer
	 */
	public function getLimit()
	{
		return $this->limit;
	}

	/**
	 * Set dedup
	 * 
	 * @param integer $dedup
	 * @return self
	 */
	public function setDedup($dedup)
	{
		$this->dedup = $dedup;

		return $this;
	}

	/**
	 * Get dedup
	 * 
	 * @return integer
	 */
	public function getDedup()
	{
		return $this->dedup;
	}

}