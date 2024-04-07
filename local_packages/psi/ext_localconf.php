<?php

declare(strict_types=1);

defined('TYPO3') or die();

$GLOBALS['TYPO3_CONF_VARS'] = array_replace_recursive($GLOBALS['TYPO3_CONF_VARS'], [
    'EXTENSIONS' => [
        'backend' => [
            'backendFavicon' => 'EXT:psi/Resources/Public/Icons/Extension.svg',
            'backendLogo' => 'EXT:psi/Resources/Public/Icons/Extension.svg',
            'loginBackgroundImage' => 'EXT:psi/Resources/Public/Images/Background.jpeg',
            'loginFootnote' => 'Made with ❤️ in Fuerteventura',
            'loginHighlightColor' => '#99c6bb',
            'loginLogo' => 'EXT:psi/Resources/Public/Icons/Extension.svg',
        ],
    ],
]);
