<?php
namespace I4W\Sms\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Kevin Schu <kevin.schu@innovations4web.de>, innovations4web
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 *
 *
 * @package sms
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Contact extends AbstractEntity
{
	/**
	 * name
	 *
	 * @var \string
	 */
	protected $name;

	/**
	 * number
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $number;

	/**
	 * Returns the name
	 *
	 * @return \string $name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param \string $name
	 * @return void
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * Returns the number
	 *
	 * @return \string $number
	 */
	public function getNumber()
	{
		return $this->number;
	}

	/**
	 * Sets the number
	 *
	 * @param \string $number
	 * @return void
	 */
	public function setNumber($number)
	{
		$this->number = $number;
	}
}