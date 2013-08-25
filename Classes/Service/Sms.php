<?php

namespace I4W\Sms\Service;

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

use Esendex\Authentication\LoginAuthentication;
use Esendex\DispatchService;
use Esendex\MessageHeaderService;
use Esendex\Model\DispatchMessage;
use Esendex\Model\Message;
use I4W\Sms\Domain\Model\Contact;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * @package sms
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Sms
{
	/**
	 * @var LoginAuthentication
	 */
	protected $authentication;

	/**
	 * @var array
	 */
	protected $configuration;

	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
	 * @inject
	 */
	protected $configurationManager;

	/**
	 * @var \I4W\Sms\Domain\Repository\DeliveryRepository
	 * @inject
	 */
	protected $deliveryRepository;

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 * @inject
	 */
	protected $objectManager;

	/**
	 * @var \I4W\Sms\Domain\Repository\SmsRepository
	 * @inject
	 */
	protected $smsRepository;

	/**
	 * @param \I4W\Sms\Domain\Model\Sms $sms
	 */
	public function proceed(\I4W\Sms\Domain\Model\Sms $sms)
	{
		$this->smsRepository->add($sms);
		$this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager')->persistAll();
		/** @var Contact $recipient */
		foreach ($sms->getRecipients() as $recipient) {
			$response = $this->getMessageInfos(
				$this->send($sms, $recipient)
			);
			$delivery = $this->deliveryRepository->findBySmsAndRecipient($sms, $recipient);
			$delivery->setMessageId($response->id());
			$this->deliveryRepository->update($delivery);
		}
	}

	/**
	 * @param \I4W\Sms\Domain\Model\Sms $sms
	 * @param Contact $recipient
	 * @return string
	 */
	private function send(\I4W\Sms\Domain\Model\Sms $sms, \I4W\Sms\Domain\Model\Contact $recipient)
	{
		$config = $this->getConfiguration();
		$message = new DispatchMessage(
			$config['esendex']['sender_address'],
			$recipient->getNumber(),
			$sms->getText(),
			Message::SmsType
		);
		$service = new DispatchService($this->getAuthentication());
		return $service->send($message)->id();
	}

	/**
	 * @param string $messageId
	 * @return \Esendex\Model\InboxMessage|\Esendex\Model\SentMessage
	 */
	public function getMessageInfos($messageId)
	{
		$mhs = new MessageHeaderService($this->getAuthentication());
		return $mhs->message($messageId);
	}

	/**
	 * @return LoginAuthentication
	 */
	private function getAuthentication()
	{
		$config = $this->getConfiguration();
		if (FALSE === isset($this->authentication)) {
			$this->authentication = new LoginAuthentication(
				$config['esendex']['accountReference'],
				$config['esendex']['username'],
				$config['esendex']['password']
			);
		}
		return $this->authentication;
	}

	/**
	 * @return array
	 */
	private function getConfiguration()
	{
		if (FALSE === isset($this->configuration)) {
			$this->configuration = $this->configurationManager->getConfiguration(
				ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS
			);
		}
		return $this->configuration;
	}
}