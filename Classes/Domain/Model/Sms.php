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

/**
 *
 *
 * @package sms
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Sms extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
	/**
	 * @var \string
	 */
	protected $text;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\I4W\Sms\Domain\Model\Contact>
	 */
	protected $recipients;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\I4W\Sms\Domain\Model\Delivery>
	 */
	protected $deliveries;

	/**
	 * @var \I4W\Sms\Domain\Repository\DeliveryRepository
	 * @inject
	 */
	protected $deliveryRepository;

	/**
	 * @return Sms
	 */
	public function __construct()
	{
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * @return void
	 */
	protected function initStorageObjects()
	{
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->recipients = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * @return \string $text
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 * @param \string $text
	 * @return void
	 */
	public function setText($text)
	{
		$this->text = $text;
	}

	/**
	 * @param \I4W\Sms\Domain\Model\Contact $recipient
	 * @return void
	 */
	public function addRecipient(\I4W\Sms\Domain\Model\Contact $recipient)
	{
		$this->recipients->attach($recipient);
	}

	/**
	 * @param \I4W\Sms\Domain\Model\Contact $recipientToRemove The Contact to be removed
	 * @return void
	 */
	public function removeRecipient(\I4W\Sms\Domain\Model\Contact $recipientToRemove)
	{
		$this->recipients->detach($recipientToRemove);
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\I4W\Sms\Domain\Model\Contact> $recipients
	 */
	public function getRecipients()
	{
		return $this->recipients;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\I4W\Sms\Domain\Model\Contact> $recipients
	 * @return void
	 */
	public function setRecipients(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $recipients)
	{
		$this->recipients = $recipients;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\I4W\Sms\Domain\Model\Delivery> $deliveries
	 * @return void
	 */
	public function setDeliveries(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $deliveries)
	{
		$this->deliveries = $deliveries;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\I4W\Sms\Domain\Model\Delivery>
	 */
	public function getDeliveries()
	{
		if (FALSE === isset($this->deliveries)) {
			$this->deliveries = $this->deliveryRepository->findBySms($this);
		}
		return $this->deliveries;
	}
}