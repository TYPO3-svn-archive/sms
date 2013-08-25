<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_sms_domain_model_sms'] = array(
	'ctrl' => $TCA['tx_sms_domain_model_sms']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'text, recipients',
	),
	'types' => array(
		'1' => array('showitem' => 'text, recipients'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'text' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sms/Resources/Private/Language/locallang_db.xlf:tx_sms_domain_model_sms.text',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'readOnly' => 1
			),
		),
		'recipients' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:sms/Resources/Private/Language/locallang_db.xlf:tx_sms_domain_model_sms.recipients',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_sms_domain_model_contact',
				'MM' => 'tx_sms_domain_model_delivery',
				'readOnly' => 1
			),
		),
	),
);