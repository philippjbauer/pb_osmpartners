<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'PhilippBauer.PbOsmpartners',
            'Pi1',
            [
                'Map' => 'show'
            ],
            // non-cacheable actions
            [
                'Map' => 'show'
            ]
        );

    },
    $_EXTKEY
);
