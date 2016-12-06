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
 * @package b3rs3rk\steamfront
 */
class Http
{
	/**
	 * Http constructor.
	 *
	 * @param string $url
	 */
	public function __construct($url)
	{
		return $this->get($url);
	}

	protected function get($url, array $params = array(), $method = 'get')
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if ($method == 'post') {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		}
		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$data = substr($response, $headerSize);
		curl_close($ch);
		if ($httpCode != 200) {
			throw new HttpException('Could not reach ' . $url, $httpCode);
		}
		return $data;
	}
}