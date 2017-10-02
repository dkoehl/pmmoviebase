<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Pmmoviebase',
	'pm MovieBase'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Movie- Database');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pmmoviebase_domain_model_movie', 'EXT:pmmoviebase/Resources/Private/Language/locallang_csh_tx_pmmoviebase_domain_model_movie.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pmmoviebase_domain_model_movie');
$GLOBALS['TCA']['tx_pmmoviebase_domain_model_movie'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:pmmoviebase/Resources/Private/Language/locallang_db.xlf:tx_pmmoviebase_domain_model_movie',
		'label' => 'originaltitle',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'originaltitle,releasedate,title,image,backdroppath,id,popularity,category,filename,year,parental,overview,votes,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Movie.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_pmmoviebase_domain_model_movie.gif'
	),
);
