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
	 * @var array The Data retrieved from Steam Store API
	 */
	private $data;

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
	 * @var Developers
	 */
	public $developers;

	/**
	 * @var Publishers
	 */
	public $publishers;

	/**
	 * @var Pricing
	 */
	public $pricing;

	/**
	 * @var Package
	 */
	public $packages;

	/**
	 * @var Platforms
	 */
	public $platforms;

	/**
	 * @var array
	 */
	public $metacritic;

	/**
	 * @var array of Category
	 */
	public $categories;

	/**
	 * @var array of Genre
	 */
	public $genres;

	/**
	 * @var Images
	 */
	public $images;

	/**
	 * App constructor.
	 *
	 * @param array $data
	 */
	public function __construct(array $data)
	{
		$this->data = $data;

		// General
		$this->type         = $this->data['type'];
		$this->name         = $this->data['name'];
		$this->appid        = $this->data['steam_appid'];
		$this->requiredage  = $this->data['required_age'];
		$this->languages    = $this->data['supported_languages'];
		$this->website      = $this->data['website'];
		$this->developers   = $this->data['devlopers'];
		$this->publishers   = $this->data['publishers'];
		$this->metacritic   = $this->data['metacritic'];
		$this->recommends   = $this->data['recommendations'];
		$this->achievements = $this->data['achievements'];
		$this->releasedate  = $this->data['release_date'];
		$this->supportinfo  = $this->data['support_info'];

		// Descriptions
		$this->description  = new Description($data);
		// Requirements
		$this->requirements = new Requirements($data);
		// Pricing
		$this->pricing      = new Pricing($data);
		// Platforms
		$this->platforms    = new Platforms($data);

		// Categories
		foreach($data['categories'] AS $category) {
			$this->categories[] = new Category($category);
		}
		// Genres
		foreach($data['genres'] AS $genre) {
			$this->genres[] = new Genre($genre);
		}

		$this->images = new Images($data);
	}
}