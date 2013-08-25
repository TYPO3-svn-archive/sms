<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_sms_domain_model_delivery'] = array(
	'ctrl' => $TCA['tx_sms_domain_model_delivery']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'message_id, uid_local, uid_foreign',
	),
	'types' => array(
		'1' => array('showitem' => 'message_id, uid_local, uid_foreign'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'message_id' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sms/Resources/Private/Language/locallang_db.xlf:tx_sms_domain_model_delivery.message_id',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim',
				'readOnly' => 1
			),
		),
		// Sms
		'uid_local' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sms/Resources/Private/Language/locallang_db.xlf:tx_sms_domain_model_delivery.sms',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_sms_domain_model_sms',
				'minitems' => 1,
				'maxitems' => 1,
				'readOnly' => 1
			),
		),
		// Recipient/Contact
		'uid_foreign' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sms/Resources/Private/Language/locallang_db.xlf:tx_sms_domain_model_delivery.recipient',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_sms_domain_model_contact',
				'size' => 1,
				'minitems' => 1,
				'maxitems' => 1,
				'readOnly' => 1
			),
		),
	),
);