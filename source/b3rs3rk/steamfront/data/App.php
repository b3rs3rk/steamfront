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
 * @package b3rs3rk\steamfront
 */
class App
{
	/**
	 * @var string Type of App
	 */
	public $type;

	/**
	 * @var string Name of App
	 */
	public $name;

	/**
	 * @var int ID of the App
	 */
	public $appid;

	/**
	 * @var int Age Requirement
	 */
	public $requiredage;

	/**
	 * @var string Supported in-app languages
	 */
	public $languages;

	/**
	 * @var string Original app's website
	 */
	public $website;

	/**
	 * @var Requirements
	 */
	public $requirements;

	/**
	 * @var string Date of release
	 */
	public $releasedate;

	/**
	 * @var
	 */
	public $developers;

	/**
	 * @var
	 */
	public $publishers;

	/**
	 * @var Pricing
	 */
	public $pricing;

	/**
	 * @var Packages
	 */
	public $packages;

	/**
	 * @var Platforms
	 */
	public $platforms;

	/**
	 * @var string
	 */
	public $metacritic;

	/**
	 * @var Categories
	 */
	public $categories;

	/**
	 * @var Images
	 */
	public $images;

	public function __construct(array $data)
	{
		// General
		$this->type = $data['type'];
		$this->name = $data['name'];
		$this->appid = $data['steam_appid'];
		$this->requiredage = $data['required_age'];
		$this->languages = $data['supported_languages'];
		$this->website = $data['website'];
		$this->developers = $data['devlopers'];
		$this->publishers = $data['publishers'];
		$this->metacritic = $data['metacritic'];
		$this->recommends = $data['recommendations'];
		$this->achievements = $data['achievements'];
		$this->releasedate = $data['release_date'];
		$this->supportinfo = $data['support_info'];

		// Descriptions
		$this->description = new Description($data);
		// Requirements
		$this->requirements = new Requirements($data);
		// Pricing
		$this->pricing = new Pricing($data);
	}
}