<?php

namespace I4W\Sms\Tests;
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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \I4W\Sms\Domain\Model\Sms.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage SMS
 *
 * @author Kevin Schu <kevin.schu@innovations4web.de>
 */
class SmsTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \I4W\Sms\Domain\Model\Sms
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \I4W\Sms\Domain\Model\Sms();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getTextReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTextForStringSetsText() { 
		$this->fixture->setText('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getText()
		);
	}
	
	/**
	 * @test
	 */
	public function getStatusReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setStatusForStringSetsStatus() { 
		$this->fixture->setStatus('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getStatus()
		);
	}
	
	/**
	 * @test
	 */
	public function getRecipientsReturnsInitialValueForContact() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getRecipients()
		);
	}

	/**
	 * @test
	 */
	public function setRecipientsForObjectStorageContainingContactSetsRecipients() { 
		$recipient = new \I4W\Sms\Domain\Model\Contact();
		$objectStorageHoldingExactlyOneRecipients = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneRecipients->attach($recipient);
		$this->fixture->setRecipients($objectStorageHoldingExactlyOneRecipients);

		$this->assertSame(
			$objectStorageHoldingExactlyOneRecipients,
			$this->fixture->getRecipients()
		);
	}
	
	/**
	 * @test
	 */
	public function addRecipientToObjectStorageHoldingRecipients() {
		$recipient = new \I4W\Sms\Domain\Model\Contact();
		$objectStorageHoldingExactlyOneRecipient = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneRecipient->attach($recipient);
		$this->fixture->addRecipient($recipient);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneRecipient,
			$this->fixture->getRecipients()
		);
	}

	/**
	 * @test
	 */
	public function removeRecipientFromObjectStorageHoldingRecipients() {
		$recipient = new \I4W\Sms\Domain\Model\Contact();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($recipient);
		$localObjectStorage->detach($recipient);
		$this->fixture->addRecipient($recipient);
		$this->fixture->removeRecipient($recipient);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getRecipients()
		);
	}
	
}
?>