<?php

/*
 * Extend Pages Table with Nav Icon Fields
 */

defined('TYPO3') or die('Access denied.');

// Register Extra Cols
$columns = array(
    'navigation_icon' => [
        'label' => 'Navigation Icon',
        'config' => [
            'type' => 'file',
            'maxitems' => 1,
            'allowed' => 'common-image-types'
        ],
    ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $columns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'navigation_icon', '1,3,4', 'after:nav_title');

// Add Custom Doktype to Dropdown
(function () {
    // SAME as registered in ext_tables.php
    $customPageDoktype = 3737;

    // Add the new doktype to the page type selector
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'pages',
        'doktype',
        [
            'label' => 'News Item / Event',
            'value' => $customPageDoktype,
            'icon'  => 'content-news',
            'group' => 'special',
        ],
    );
})();

// Register Extra News Item Columns
$columns = [
    'location' => [
        'label' => 'Location',
        'config' => [
            'type' => 'text',
            'max' => 511,
        ]
    ],
    'eventdatetime' => [
        'label' => 'Date of Event',
        'config' => [
            'type' => 'datetime',
            'format' => 'date',
            'default' => 0,
        ]
    ]
];

// Add Columns to Pages
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'pages',
    $columns
);

$GLOBALS['TCA']['pages']['palettes']['news']['showitem'] =
    'location;Event Location,
    --linebreak--,
    eventdatetime; Event Datetime
    ';

$GLOBALS['TCA']['pages']['types'][3737] = [
    'showitem' =>
    '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general, --palette--;;standard, --palette--;;title,--palette--;;news,--div--;LLL:EXT:seo/Resources/Private/Language/locallang_tca.xlf:pages.tabs.seo, --palette--;;seo, --palette--;;robots, --palette--;;canonical, --palette--;;sitemap, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.appearance, --palette--;;layout, --palette--;;replace,--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.resources, --palette--;;media, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, --palette--;;language, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access, --palette--;;visibility, --palette--;;access, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories, categories, '

];
