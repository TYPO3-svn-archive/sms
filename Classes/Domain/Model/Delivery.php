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
class Delivery extends AbstractEntity
{
	/**
	 * @var string
	 */
	protected $messageId;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\I4W\Sms\Domain\Model\Contact>
	 */
	protected $uidForeign;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\I4W\Sms\Domain\Model\Sms>
	 */
	protected $uidLocal;

	/**
	 * @return Delivery
	 */
	public function __construct()
	{
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects()
	{
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->uidForeign = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->uidLocal = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Adds a Contact
	 *
	 * @param \I4W\Sms\Domain\Model\Contact $recipient
	 * @return void
	 */
	public function addRecipient(\I4W\Sms\Domain\Model\Contact $recipient)
	{
		$this->uidForeign->attach($recipient);
	}

	/**
	 * Removes a Contact
	 *
	 * @param \I4W\Sms\Domain\Model\Contact $recipientToRemove The Contact to be removed
	 * @return void
	 */
	public function removeRecipient(\I4W\Sms\Domain\Model\Contact $recipientToRemove)
	{
		$this->uidForeign->detach($recipientToRemove);
	}

	/**
	 * Returns the recipient
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\I4W\Sms\Domain\Model\Contact> $recipient
	 */
	public function getRecipient()
	{
		$recipient = $this->uidForeign;
		$recipient->rewind();
		return $recipient->current();
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\I4W\Sms\Domain\Model\Contact> $recipient
	 * @return void
	 */
	public function setRecipient(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $recipient)
	{
		$this->uidForeign = $recipient;
	}

	/**
	 * @param \I4W\Sms\Domain\Model\Sms $sm
	 * @return void
	 */
	public function addSm(\I4W\Sms\Domain\Model\Sms $sm)
	{
		$this->uidLocal->attach($sm);
	}

	/**
	 * @param \I4W\Sms\Domain\Model\Sms $smToRemove The Sms to be removed
	 * @return void
	 */
	public function removeSm(\I4W\Sms\Domain\Model\Sms $smToRemove)
	{
		$this->uidLocal->detach($smToRemove);
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\I4W\Sms\Domain\Model\Sms> $sms
	 */
	public function getSms()
	{
		$sms = $this->uidLocal;
		$sms->rewind();
		return $sms->current();
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\I4W\Sms\Domain\Model\Sms> $sms
	 * @return void
	 */
	public function setSms(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $sms)
	{
		$this->uidLocal = $sms;
	}

	/**
	 * @param string $messageId
	 */
	public function setMessageId($messageId)
	{
		$this->messageId = $messageId;
	}

	/**
	 * @return string
	 */
	public function getMessageId()
	{
		return $this->messageId;
	}
}