<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Pmmoviebase.' . $_EXTKEY,
	'Pmmoviebase',
	array(
		'Movie' => 'list, show, search',
		
	),
	// non-cacheable actions
	array(
		'Movie' => 'search',
		
	)
);

/**
 * Command Controller for importing
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Pmmoviebase\\Pmmoviebase\\Command\\MovieScraper'] = array(
    'extension'        => $_EXTKEY,
    'title'            => 'MovieDatabase API Import',
    'description'      => 'MovieDatabase API - Imports Movies from Filelist'
);