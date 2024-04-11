<?php

use TYPO3\CMS\Core\DataHandling\PageDoktypeRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') or die();

// Add page type to system
GeneralUtility::makeInstance(PageDoktypeRegistry::class)->add(
    \Jacuzzi\Psi\Domain\NewsPage::NEWS_PAGE_DOKTYPE,
    [
        'type' => 'web',
        'allowedTables' => '*',
    ],
);
