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
 * @package steamfront\source
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
	const FULL_LIST_PATH = 'ISteamApps/GetAppList/v2/';

	/**
	 * Path to featured apps request
	 */
	const FEATURED_PATH = 'api/featured/';

	/**
	 * Path to featured categories request';
	 */
	const FEATURED_CATS_PATH = 'api/featuredcategories/';

	/**
	 * Path to App details request
	 */
	const DETAILS_PATH = 'api/appdetails?appids=';

	/**
	 * Gets requested data using Httpful -- automatically detects JSON response and decodes
	 *
	 * @param string $root
	 * @param string $request
	 *
	 * @return Http
	 */
	public function get($root, $request)
	{
		$url = $root . $request;

		 $response = new Http($url);

		if (isset($response->success) && $response->success === true) {
			return new App($response->body);
		}
	}

	/**
	 * Retrieves Full Stea Library Info and returns in JSON decoded format
	 *
	 * @return \Httpful\Response
	 */
	public function getFullAppList()
	{
		return $this->get(self::STEAM_API_ROOT, self::FULL_LIST_PATH . self::STEAM_API_RESP_TYPE);
	}

	/**
	 * Retrieves Featured Steam Games Info and returns in JSON decoded format
	 *
	 * @return \Httpful\Response
	 */
	public function getFeaturedApps()
	{
		return $this->get(self::STEAM_STORE_ROOT, self::FEATURED_PATH);
	}

	/**
	 * Retrieves Featured Steam Games Info and returns in JSON decoded format
	 *
	 * @return \Httpful\Response
	 */
	public function getFeaturedCategories()
	{
		return $this->get(self::STEAM_STORE_ROOT, self::FEATURED_CATS_PATH);
	}

	/**
	 * Retrieves App information for a specific AppID
	 *
	 * @param int $appId
	 *
	 * @return \Httpful\Response
	 */
	public function getAppDetails($appId)
	{
		return $this->get(self::STEAM_STORE_ROOT, self::DETAILS_PATH . $appId);
	}
}