<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'PhilippBauer.PbOsmpartners',
            'Pi1',
            'OpenStreetMap Partners'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'OpenStreetMap Partners');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pbosmpartners_domain_model_map', 'EXT:pb_osmpartners/Resources/Private/Language/locallang_csh_tx_pbosmpartners_domain_model_map.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pbosmpartners_domain_model_map');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_pbosmpartners_domain_model_partner', 'EXT:pb_osmpartners/Resources/Private/Language/locallang_csh_tx_pbosmpartners_domain_model_partner.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_pbosmpartners_domain_model_partner');

    },
    $_EXTKEY
);
