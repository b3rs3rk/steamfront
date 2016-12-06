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
 * Class Pricing
 *
 * @package b3rs3rk\steamfront\data
 */
class Pricing
{
	/**
	 * @var bool App is Free or Paid
	 */
	public $free;

	/**
	 * @var string Name of currency
	 */
	public $currency;

	/**
	 * @var int initial price in cents
	 */
	public $initial;

	/**
	 * @var int final price in cents
	 */
	public $final;

	/**
	 * @var int percentage of discount
	 */
	public $discountpct;

	public function __construct($data)
	{
		$this->free        = $data['isfree'];
		$this->currency    = $data['priceoverview']['currency'];
		$this->initial     = $data['priceoverview']['initial'];
		$this->final       = $data['priceoverview']['final'];
		$this->discountpct = $data['priceoverview']['discount_percentage'];

		return $this;
	}
}