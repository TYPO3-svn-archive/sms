<?php

namespace I4W\Sms\ViewHelpers;

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

use I4W\Sms\Domain\Model\Delivery;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class DeliveryViewHelper
 * @package I4W\Cathouse\ViewHelpers
 */
class DeliveryViewHelper extends AbstractViewHelper
{
	/**
	 * @var \I4W\Sms\Service\Sms
	 * @inject
	 */
	protected $smsService;

	/**
	 * @param Delivery $delivery
	 * @return array
	 */
	public function render(Delivery $delivery)
	{
		try {
			$response = $this->smsService->getMessageInfos($delivery->getMessageId());
		} catch (\Exception $e) {
			return array(
				'status' => '[error: ' . $e->getMessage() . ']',
				'sentAt' => '[error: ' . $e->getMessage() . ']',
				'deliveredAt' => '[error: ' . $e->getMessage() . ']',
			);
		}
		return array(
			'status' => $response->status(),
			'sentAt' => $response->sentAt(),
			'deliveredAt' => $response->deliveredAt(),
		);
	}
}