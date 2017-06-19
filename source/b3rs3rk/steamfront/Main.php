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

namespace b3rs3rk\steamfront;

use b3rs3rk\steamfront\http\Http;
use b3rs3rk\steamfront\data\App;

/**
 * Class SteamFront
 *
 * @package b3rs3rk\steamfront
 */
class Main
{
	/**
	 * Top domain URL of the Steam API
	 */
	const STEAM_API_ROOT = 'https://api.steampowered.com/';

	/**
	 * Top domain URL of the Steam API
	 */
	const STEAM_STORE_ROOT = 'https://store.steampowered.com/';

	/**
	 * Requested return format for full list
	 */
	const STEAM_API_RESP_TYPE = '?format=json';

	/**
	 * Path to the JSON encoded list of all Steam AppIDs
	 */
	const APPS_FULL_LIST_PATH = 'ISteamApps/GetAppList/v2/';

	/**
	 * Path to featured apps request
	 */
	const FEATURED_APPS_PATH = 'api/featured/';

	/**
	 * Path to featured categories request';
	 */
	const FEATURED_CATS_PATH = 'api/featuredcategories/';

	/**
	 * Path to App details request
	 */
	const APP_DETAILS_PATH = 'api/appdetails?appids=';

	/**
	 * @var string The two letter country code from which to retrieve localized currency information
	 */
	protected $countryCode;

	/**
	 * @var string The language (in English) from which to retrieve localized strings e.g. German, Italian
	 */
	protected $localLang;

	/**
	 * Main constructor.
	 *
	 * @param array $options
	 */
	public function __construct(array $options = array())
	{
		$defaults = [
			'country_code' => 'us',
		    'local_lang'   => 'english',
		];
		$options += $defaults;

		$this->countryCode = '&cc=' . $options['country_code'];
		$this->localLang = '&l=' . $options['local_lang'];
	}

	/**
	 * Gets requested data using Http client and returns the json decoded response
	 *
	 * @param string $root The root url of the request
	 * @param string $path The path of the request
	 *
	 * @return array|bool The JSON decoded response or false
	 */
	public function get($root, $path)
	{
		$url = $root . $path;

		$response = Http::get($url . $this->countryCode . $this->localLang);

		if (is_array($response)) {

			return $response;
		} else {

			return false;
		}
	}

	/**
	 * Retrieves full Steam library info and returns in JSON decoded format
	 *
	 * @return array Steam library full app listing decoded JSON response
	 */
	public function getFullAppList()
	{
		return $this->get(self::STEAM_API_ROOT, self::APPS_FULL_LIST_PATH . self::STEAM_API_RESP_TYPE);
	}

	/**
	 * Retrieves Featured Steam Games Info and returns in JSON decoded format
	 *
	 * @return array Featured applications -- no manipulation
	 */
	public function getFeaturedApps()
	{
		 return $this->get(self::STEAM_STORE_ROOT, self::FEATURED_APPS_PATH);
	}

	/**
	 * Retrieves Featured Steam Games Info and returns in JSON decoded format
	 *
	 * @return array|bool
	 */
	public function getFeaturedCategories()
	{
		return $this->get(self::STEAM_STORE_ROOT, self::FEATURED_CATS_PATH);
	}

	/**
	 * Retrieves App information for a specific AppID
	 *
	 * @param int    $id The id argument settings value for the API query
	 * @param string $filter The filter argument settings value for the API query
	 *
	 * @return false|App The normalized data return for the requested Steam Application ID
	 */
	public function getAppDetails($id, $filter = '')
	{
		if (!empty($filter)) {
			$filter = '&filters=' . $filter;
		}

		$app = $this->get(self::STEAM_STORE_ROOT, self::APP_DETAILS_PATH . $id . $filter);

		if ($app[$id]['success'] == true) {
			return new App($app[$id]['data']);
		} else {
			return false;
		}
	}
}
