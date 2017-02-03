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

namespace b3rs3rk\steamfront\http;

/**
 * Class Http
 *
 * @package b3rs3rk\steamfront\http
 */
class Http
{
	/**
	 * @param string $url The url cUrl should get
	 *
	 * @return string|array The cUrl response data -- if JSON detected, decode first
	 * @throws HttpException Thrown if not 200 OK
	 */
	public static function get(string $url)
	{
		$ch = curl_init($url);

		curl_setopt_array(
			$ch,
			[
				CURLOPT_HEADER         => 1,
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_SSL_VERIFYPEER => 0,
			]
		);

		$response = curl_exec($ch);

		$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($responseCode != 200) {
			throw new HttpException('Could not reach ' . $url, $responseCode);
		}
		$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
		$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

		curl_close($ch);

		$response = substr($response, $headerSize);

		if (is_null($response)) {
			throw new HttpException('You are exceeding the API request limit.  Please wait longer between requests.', 400);
		}

		if(stripos($contentType, 'application/json') !== false) {
			$response = json_decode($response, true);
		}

		return $response;
	}
}