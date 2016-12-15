<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program (see LICENSE.txt in the base directory.  If
 * not, see:
 *
 * @link      <http://www.gnu.org/licenses/>.
 * @author    b3rs3rk
 * @copyright 2016
 */

namespace b3rs3rk\steamfront\data;

/**
 * Class App - provides object oriented response mapping for Steam Apps
 *
 * @package b3rs3rk\steamfront\data
 */
class App
{
	/**
	 * @var int ID of the App
	 */
	public $appid;

	/**
	 * @var string Name of App
	 */
	public $name;

	/**
	 * @var string Type of App
	 */
	public $type;

	/**
	 * @var string Date of release
	 */
	public $releasedate;

	/**
	 * @var int Age Requirement
	 */
	public $requiredage;

	/**
	 * @var string Supported in-app languages
	 */
	public $languages;

	/**
	 * @var array
	 */
	public $description;

	/**
	 * @var array
	 */
	public $developers;

	/**
	 * @var array
	 */
	public $publishers;

	/**
	 * @var string Original app's website
	 */
	public $website;

	/**
	 * @var array
	 */
	public $supportinfo;

	/**
	 * @var array
	 */
	public $platforms;

	/**
	 * @var array
	 */
	public $requirements;

	/**
	 * @var array
	 */
	public $pricing;

	/**
	 * @var array
	 */
	public $metacritic;

	/**
	 * @var array
	 */
	public $categories;

	/**
	 * @var array
	 */
	public $genres;

	/**
	 * @var array
	 */
	public $images;

	/**
	 * @var array
	 */
	public $achievements;

	/**
	 * @var array
	 */
	public $recommendations;

	/**
	 * App constructor.  Calls all sub-functions to fill class variables
	 *
	 * @param array $data
	 */
	public function __construct(array $data)
	{
		$this->data = $data;

		$this->setCritical();
		$this->setRatings();
		$this->setDemographics();
		$this->setDescriptions();
		$this->setSpecifications();
		$this->setClassifications();
		$this->setImages();
		$this->setPricing();

		unset($this->data); // Unset $data or raw response is returned with class object
	}

	/**
	 * Sets absolutely critical info
	 */
	protected function setCritical()
	{
		$this->setNonMatching($this->appid, 'steam_appid');
		$this->setMatching('type');
		$this->setMatching('name');
		$this->setNonMatching($this->releasedate, 'release_date');
	}

	/**
	 * Assigns ratings information to the data return
	 */
	protected function setRatings()
	{
		$this->setMatching('metacritic');
		$this->setMatching('recommendations');
	}

	/**
	 * Assigns demographics information to the data return
	 */
	protected function setDemographics()
	{
		$this->setNonMatching($this->requiredage, 'required_age');
		$this->setNonMatching($this->languages, 'supoorted_languages');
	}

	/**
	 * Assigns authoring information to the data return
	 */
	protected function setAuthoring()
	{
		$this->setMatching('developers');
		$this->setMatching('publishers');
		$this->setMatching('website');
		$this->setNonMatching($this->supportinfo, 'support_info');
	}

	/**
	 * Assigns descriptions to the data return
	 */
	protected function setDescriptions()
	{
		$keys = [
			'detailed' => 'detailed_description',
			'short'    => 'short_description',
			'about'    => 'about_the_game',
		];

		$this->setVarWithArray($this->description, $keys);
	}

	/**
	 * Assigns specifications to the data return
	 */
	protected function setSpecifications()
	{
		$this->setMatching('platforms');

		$keys = [
			'pc'    => 'pc_requirements',
			'mac'   => 'mac_requirements',
			'linux' => 'linux_requirements',
		];

		$this->setVarWithArray($this->requirements, $keys);
	}

	/**
	 * Assigns classification to the data return
	 */
	protected function setClassifications()
	{
		$this->setMatching('categories');
		$this->setMatching('genres');
	}

	/**
	 * Assigns all imaged based information to one sub-key in the return
	 */
	protected function setImages()
	{
		$keys = [
			'header'      => 'header_image',
			'background'  => 'background',
			'screenshots' => 'screenshots',
		];

		$this->setVarWithArray($this->images, $keys);
	}

	/**
	 * Assigns the pricing information to the data in the return
	 */
	protected function setPricing()
	{
		$this->setNonMatching($this->pricing, 'price_overview');
	}

	/**
	 * Sets the named class value to the differently named key
	 *
	 * @var $this->$classvar The class variable to set
	 * @param string $key The non matching key to retrieve the data from
	 */
	protected function setNonMatching(&$classVar, string $key)
	{
		if (isset($this->data[$key])) {
			$classVar = $this->data[$key];
		}
	}

	/**
	 * Sets the class value to the key value with the same key name
	 *
	 * @param string $key The matching key data to class value to set
	 */
	protected function setMatching(string $key)
	{
		if (isset($this->data[$key])) {
			$this->$key = $this->data[$key];
		}
	}

	/**
	 * Sets an array type class variable based on an associative array of keys as their values
	 * Checks each key to make sure it exists and strips html tags from API response to normalize data
	 *
	 * @var $this->$classvar The class variable to set
	 * @param array $slice The array of data keys and values to match
	 */
	protected function setVarWithArray(&$classVar, array $slice)
	{
		foreach($slice AS $key => $value) {
			if (isset($this->data[$value])) {
				$keydata = $this->data[$value];
				if (is_array($keydata)) {
					array_walk_recursive($keydata, 'strip_tags');
				} else {
					$keydata = strip_tags($keydata);
				}
				$classVar[$key] = $keydata;
			}
		}
	}
}