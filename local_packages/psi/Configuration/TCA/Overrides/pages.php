<?php

/*
 * Extend Pages Table with Nav Icon Fields
 */

defined('TYPO3') or die('Access denied.');

// Register Extra Cols
$columns = [
    'navigation_icon' => [
        'label' => 'Navigation Icon',
        'config' => [
            'type' => 'file',
            'maxitems' => 1,
            'allowed' => 'common-image-types'
        ],
    ]
];


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $columns);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'navigation_icon', '1,3,4', 'after:nav_title');
