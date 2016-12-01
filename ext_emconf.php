<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "pb_osmpartners"
 *
 * Auto generated by Extension Builder 2016-11-18
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'OpenStreetMap Partners',
    'description' => 'Shows partner entries on a OpenStreetMap',
    'category' => 'plugin',
    'author' => 'Philipp Bauer',
    'author_email' => 'hello@philippbauer.org',
    'state' => 'alpha',
    'internal' => '',
    'uploadfolder' => '1',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '0.1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '6.2.0-7.6.99',
            'static_info_tables' => '6.3.0-6.3.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];