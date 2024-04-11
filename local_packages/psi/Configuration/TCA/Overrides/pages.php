<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die('Access denied.');

ExtensionManagementUtility::addTCAcolumns(
    'pages',
    [
        'navigation_icon' => [
            'label' => 'Navigation Icon',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
                'allowed' => 'common-image-types',
            ],
        ],
        'location' => [
            'label' => 'Location',
            'config' => [
                'type' => 'text',
            ]
        ],
        'eventdatetime' => [
            'label' => 'Date of Event',
            'config' => [
                'type' => 'datetime',
                'format' => 'date',
                'default' => 0,
            ]
        ],
    ]
);

ExtensionManagementUtility::addToAllTCAtypes('pages', 'navigation_icon', '1,3,4', 'after:nav_title');
ExtensionManagementUtility::addTcaSelectItem(
    'pages',
    'doktype',
    [
        'label' => 'News Item / Event',
        'value' => \Jacuzzi\Psi\Domain\NewsPage::NEWS_PAGE_DOKTYPE,
        'icon'  => 'content-news',
        'group' => 'special',
    ],
);

$GLOBALS['TCA']['pages']['ctrl']['typeicon_classes'][\Jacuzzi\Psi\Domain\NewsPage::NEWS_PAGE_DOKTYPE] = 'content-news';
$GLOBALS['TCA']['pages']['palettes']['news']['showitem'] = 'location;Event Location,--linebreak--,eventdatetime; Event Datetime';

$GLOBALS['TCA']['pages']['types'][\Jacuzzi\Psi\Domain\NewsPage::NEWS_PAGE_DOKTYPE] = [
    'showitem' => '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;standard,
        --palette--;;title,
        --palette--;;news,
        --div--;LLL:EXT:seo/Resources/Private/Language/locallang_tca.xlf:pages.tabs.seo,
        --palette--;;seo,
        --palette--;;robots,
        --palette--;;canonical,
        --palette--;;sitemap,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.appearance,
        --palette--;;layout,
        --palette--;;replace,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.resources,
        --palette--;;media,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
        --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access,
        --palette--;;visibility,
        --palette--;;access,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories, categories,'
];
