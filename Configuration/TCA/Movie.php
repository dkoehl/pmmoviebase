<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_pmmoviebase_domain_model_movie'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_pmmoviebase_domain_model_movie']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, originaltitle, releasedate, title, image, backdroppath, id, popularity, category, filename, year, parental, overview, votes',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, originaltitle, releasedate, title, image, backdroppath, id, popularity, category, filename, year, parental, overview, votes, hash, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_pmmoviebase_domain_model_movie',
				'foreign_table_where' => 'AND tx_pmmoviebase_domain_model_movie.pid=###CURRENT_PID### AND tx_pmmoviebase_domain_model_movie.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'originaltitle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pmmoviebase/Resources/Private/Language/locallang_db.xlf:tx_pmmoviebase_domain_model_movie.originaltitle',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'releasedate' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pmmoviebase/Resources/Private/Language/locallang_db.xlf:tx_pmmoviebase_domain_model_movie.releasedate',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pmmoviebase/Resources/Private/Language/locallang_db.xlf:tx_pmmoviebase_domain_model_movie.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'image' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pmmoviebase/Resources/Private/Language/locallang_db.xlf:tx_pmmoviebase_domain_model_movie.image',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file_reference',
				'uploadfolder' => '',
				'show_thumbs' => 1,
				'size' => 1,
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' => '',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'backdroppath' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pmmoviebase/Resources/Private/Language/locallang_db.xlf:tx_pmmoviebase_domain_model_movie.backdroppath',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file_reference',
				'uploadfolder' => '',
				'show_thumbs' => 1,
				'size' => 1,
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' => '',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'id' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pmmoviebase/Resources/Private/Language/locallang_db.xlf:tx_pmmoviebase_domain_model_movie.id',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'popularity' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pmmoviebase/Resources/Private/Language/locallang_db.xlf:tx_pmmoviebase_domain_model_movie.popularity',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'category' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pmmoviebase/Resources/Private/Language/locallang_db.xlf:tx_pmmoviebase_domain_model_movie.category',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'filename' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pmmoviebase/Resources/Private/Language/locallang_db.xlf:tx_pmmoviebase_domain_model_movie.filename',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'year' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pmmoviebase/Resources/Private/Language/locallang_db.xlf:tx_pmmoviebase_domain_model_movie.year',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'parental' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pmmoviebase/Resources/Private/Language/locallang_db.xlf:tx_pmmoviebase_domain_model_movie.parental',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'overview' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pmmoviebase/Resources/Private/Language/locallang_db.xlf:tx_pmmoviebase_domain_model_movie.overview',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'votes' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:pmmoviebase/Resources/Private/Language/locallang_db.xlf:tx_pmmoviebase_domain_model_movie.votes',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'hash' => array(
			'exclude' => 1,
			'label' => 'md5 Hash',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		
	),
);
