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
	protected $type;

	/**
	 * @var string Name of App
	 */
	protected $name;

	/**
	 * @var int ID of the App
	 */
	protected $appid;

	/**
	 * @var int Age Requirement
	 */
	protected $requiredage;

	/**
	 * @var string Supported in-app languages
	 */
	protected $languages;

	/**
	 * @var string Original app's website
	 */
	protected $website;

	/**
	 * @var Requirements
	 */
	protected $requirements;

	/**
	 * @var string Date of release
	 */
	protected $releasedate;

	/**
	 * @var
	 */
	protected $developers;

	/**
	 * @var
	 */
	protected $publishers;

	/**
	 * @var Pricing
	 */
	protected $pricing;

	/**
	 * @var Packages
	 */
	protected $packages;

	/**
	 * @var Platforms
	 */
	protected $platforms;

	/**
	 * @var string
	 */
	protected $metacritic;

	/**
	 * @var
	 */
	protected $categories;

	/**
	 * @var
	 */
	protected $images;
}