<?php

namespace I4W\Sms\Domain\Repository;

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

use I4W\Sms\Domain\Model\Sms;
use I4W\Sms\Domain\Model\Contact;
use I4W\Sms\Domain\Model\Delivery;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * @package sms
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class DeliveryRepository extends Repository
{
	/**
	 * @param Sms $sms
	 * @param Contact $recipient
	 * @return Delivery
	 */
	public function findBySmsAndRecipient(Sms $sms, Contact $recipient)
	{
		$query = $this->createQuery();
		$query->matching(
			$query->logicalAnd(
				$query->equals('uid_local', $sms->getUid()),
				$query->equals('uid_foreign', $recipient->getUid())
			));
		return $query->execute()->getFirst();
	}

	/**
	 * @param Sms $sms
	 * @return QueryResultInterface
	 */
	public function findBySms(Sms $sms)
	{
		$query = $this->createQuery();
		$query->matching($query->equals('uid_local', $sms->getUid()));
		return $query->execute();
	}
}