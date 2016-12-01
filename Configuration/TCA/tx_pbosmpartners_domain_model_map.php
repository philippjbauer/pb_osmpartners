<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_map',
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

        ],
        'searchFields' => 'name,latitude,longitude,styles,partners,',
        'iconfile' => 'EXT:pb_osmpartners/Resources/Public/Icons/tx_pbosmpartners_domain_model_map.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, latitude, longitude, styles, partners',
    ],
    'types' => [
        '1' => ['showitem' => '--div--;Karte, name, --palette--;Kartenmittelpunkt;center, --div--;CSS Stil, styles, --div--;Partner, partners, --div--;Zugriff, sys_language_uid, l10n_parent, l10n_diffsource, hidden, '],
    ],
    'palettes' => [
        'center' => ['showitem' => 'latitude, longitude', 'canNotCollapse' => true],
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
                'foreign_table' => 'tx_pbosmpartners_domain_model_map',
                'foreign_table_where' => 'AND tx_pbosmpartners_domain_model_map.pid=###CURRENT_PID### AND tx_pbosmpartners_domain_model_map.sys_language_uid IN (-1,0)',
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

	    'name' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_map.name',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
			    'eval' => 'trim,required'
			],
	        
	    ],
	    'latitude' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_map.latitude',
	        'config' => [
			    'type' => 'input',
			    'size' => 30,
                'max' => 11,
                // 'eval' => 'double2,required'
            ]
            
        ],
        'longitude' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_map.longitude',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 11,
			    // 'eval' => 'double2,required'
			]
	        
	    ],
	    'styles' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_map.styles',
	        'config' => [
			    'type' => 'text',
			    'cols' => 40,
			    'rows' => 15,
			    'eval' => 'trim'
			]
	        
	    ],
	    'partners' => [
	        'exclude' => 0,
	        'label' => 'LLL:EXT:pb_osmpartners/Resources/Private/Language/locallang_db.xlf:tx_pbosmpartners_domain_model_map.partners',
	        'config' => [
			    'type' => 'inline',
			    'foreign_table' => 'tx_pbosmpartners_domain_model_partner',
			    'foreign_field' => 'map',
			    'maxitems' => 9999,
			    'appearance' => [
			        'collapseAll' => 0,
			        'levelLinksPosition' => 'top',
			        'showSynchronizationLink' => 1,
			        'showPossibleLocalizationRecords' => 1,
			        'showAllLocalizationLink' => 1
			    ],
			],

	    ],
        
    ],
];
