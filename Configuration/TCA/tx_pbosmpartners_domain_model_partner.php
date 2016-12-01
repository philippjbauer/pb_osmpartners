<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_partner',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => 1,
		'versioningWS' => 2,
        'versioning_followPages' => true,

        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
        'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'name,street,houseno,zip,city,state,url,summary,description,extra,logo,latitude,longitude,country,',
        'iconfile' => 'EXT:pb_osmpartners/Resources/Public/Icons/tx_pbosmpartners_domain_model_partner.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, street, houseno, zip, city, state, url, summary, description, extra, logo, latitude, longitude, country',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, street, houseno, zip, city, state, url, summary, description, extra, logo, latitude, longitude, country, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages'
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_pbosmpartners_domain_model_partner',
                'foreign_table_where' => 'AND tx_pbosmpartners_domain_model_partner.pid=###CURRENT_PID### AND tx_pbosmpartners_domain_model_partner.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],

	    'name' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_partner.name',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim,required'
			],
	        
	    ],
	    'street' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_partner.street',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim,required'
			],
	        
	    ],
	    'houseno' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_partner.houseno',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim,required'
			],
	        
	    ],
	    'zip' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_partner.zip',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim,required'
			],
	        
	    ],
	    'city' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_partner.city',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim,required'
			],
	        
	    ],
	    'state' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_partner.state',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	        
	    ],
	    'url' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_partner.url',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim'
			],
	        
	    ],
	    'summary' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_partner.summary',
	        'config' => [
			    'type' => 'text',
			    'cols' => 40,
			    'rows' => 15,
			    'eval' => 'trim',
			],
	        'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
	    ],
	    'description' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_partner.description',
	        'config' => [
			    'type' => 'text',
			    'cols' => 40,
			    'rows' => 15,
			    'eval' => 'trim',
			],
	        'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
	    ],
	    'extra' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_partner.extra',
	        'config' => [
			    'type' => 'text',
			    'cols' => 40,
			    'rows' => 15,
			    'eval' => 'trim',
			],
	        'defaultExtras' => 'richtext:rte_transform[mode=ts_css]'
	    ],
	    'logo' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_partner.logo',
	        'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			    'logo',
			    [
			        'appearance' => [
			            'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
			        ],
			        'foreign_types' => [
			            '0' => [
			                'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette'
			            ],
			            \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
			                'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette'
			            ],
			            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
			                'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette'
			            ],
			            \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
			                'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette'
			            ],
			            \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
			                'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette'
			            ],
			            \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
			                'showitem' => '
			                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
			                --palette--;;filePalette'
			            ]
			        ],
			        'maxitems' => 1
			    ],
			    $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),
	        
	    ],
	    'latitude' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_partner.latitude',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'max' => 11
			    // 'eval' => 'double2'
			]
	        
	    ],
	    'longitude' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_partner.longitude',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'max' => 11
			    // 'eval' => 'double2'
			]
	        
	    ],
	    'country' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_partner.country',
	        'config' => [
			    'type' => 'select',
			    'renderType' => 'selectSingle',
			    'foreign_table' => 'static_countries',
			    'minitems' => 0,
			    'maxitems' => 1,
			],
	        
	    ],
        
        'map' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
