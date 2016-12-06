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
	 * App constructor.
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

		unset($this->data);
	}

	/**
	 * Sets absolutely critical info
	 */
	protected function setCritical()
	{
		$this->setNonMatching('appid', 'steam_appid');
		$this->setMatching('type');
		$this->setMatching('name');
		$this->setNonMatching('releasedate', 'release_date');
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
		$this->setNonMatching('requiredage', 'required_age');
		$this->setNonMatching('languages', 'supoorted_languages');
	}

	/**
	 * Assigns authoring information to the data return
	 */
	protected function setAuthoring()
	{
		$this->setMatching('developers');
		$this->setMatching('publishers');
		$this->setMatching('website');
		$this->setNonMatching('supportinfo', 'support_info');
	}

	/**
	 * Assigns descriptions to the data return
	 */
	protected function setDescriptions()
	{
		$this->description['detailed'] = $this->data['detailed_description'];
		$this->description['short']    = $this->data['short_description'];
		$this->description['about']    = $this->data['about_the_game'];
	}

	/**
	 * Assigns specifications to the data return
	 */
	protected function setSpecifications()
	{
		$this->setMatching('platforms');
		$this->requirements['pc']    = $this->data['pc_requirements'];
		$this->requirements['mac']   = $this->data['mac_requirements'];
		$this->requirements['linux'] = $this->data['linux_requirements'];
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
		$this->images['header']      = $this->data['header_image'];
		$this->images['background']  = $this->data['background'];
		$this->images['screenshots'] = $this->data['screenshots'];
	}

	/**
	 * Assigns the pricing information to the data in the return
	 */
	protected function setPricing()
	{
		$this->setNonMatching('pricing', 'price_overview');
	}

	/**
	 * Sets the named class value to the differently named key
	 *
	 * @param string $classvar
	 * @param string $key
	 */
	protected function setNonMatching($classvar, $key)
	{
		if (isset($this->data[$key])) {
			$this->$classvar = $this->data[$key];
		}
	}

	/**
	 * Sets the class value to the key value with the same key name
	 *
	 * @param string $key
	 */
	protected function setMatching($key)
	{
		if (isset($this->data[$key])) {
			$this->$key = $this->data[$key];
		}
	}
}