<?php

namespace I4W\Sms\Controller;

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
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Extensionmanager\Controller\ActionController;

/**
 * @package sms
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class SmsController extends ActionController
{
	/**
	 * @var \I4W\Sms\Service\Sms
	 * @inject
	 */
	protected $smsService;

	/**
	 * @var \I4W\Sms\Domain\Repository\SmsRepository
	 * @inject
	 */
	protected $smsRepository;

	/**
	 * @var \I4W\Sms\Domain\Repository\ContactRepository
	 * @inject
	 */
	protected $contactRepository;

	/**
	 * @param Sms $sms
	 * @dontvalidate $sms
	 * @return void
	 */
	public function newAction(Sms $sms = NULL)
	{
		$this->view->assign('sms', $sms);
		$this->view->assign('recipients', $this->contactRepository->findAll());
	}

	/**
	 * @param Sms $sms
	 * @return void
	 */
	public function sendAction(Sms $sms)
	{
		$this->smsService->proceed($sms);
		$this->flashMessageContainer->add('SMS successfully sent!', 'Success', FlashMessage::OK);
		$this->redirect('delivery', null, null, array(
			'sms' => $sms
		));
	}

	public function historyAction()
	{
		$this->view->assign('allSms', $this->smsRepository->findAll());
	}

	/**
	 * @param Sms $sms
	 * @return void
	 */
	public function deliveryAction(Sms $sms)
	{
		$this->view->assign('deliveries', $sms->getDeliveries());
	}
}