<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'I4W.' . $_EXTKEY,
	'Contact',
	array(
		'Contact' => 'list, show, new, create, edit, update, delete',
	),
	// non-cacheable actions
	array(
		'Contact' => 'create, update, delete',
	)
);

require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY, 'Resources/Libraries/esendex-php-sdk/src/autoload.php');