<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * PSI Text Element
 */
ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:EXT:psi/Resources/Private/Language/locallang_db.xlf:ctype.text',
        'value' => 'text',
        'icon' => 'content-text',
        'group' => 'PSI',
        'description' => 'LLL:EXT:psi/Resources/Private/Language/locallang_db.xlf:ctype.text.description',
    ]
);

$GLOBALS['TCA']['tt_content']['types']['text'] = [
    'showitem' => '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
    --palette--;;general,
    --palette--;;headers, bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
    --palette--;;language, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
    --palette--;;hidden,
    --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes, rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
    ',
    'columnsOverrides' => [
        'bodytext' => [
            'config' => [
                'type' => 'text',
                'cols' => 50,
                'rows' => 5,
                'enableRichtext' => true,
                'richtextConfiguration' => 'default'
            ],
        ],
    ],
];

$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['text'] = 'content-text';

/**
 * PSI Image Element
 */
ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:EXT:psi/Resources/Private/Language/locallang_db.xlf:ctype.image',
        'value' => 'image',
        'icon' => 'content-image',
        'group' => 'PSI',
        'description' => 'LLL:EXT:psi/Resources/Private/Language/locallang_db.xlf:ctype.image.description',
    ]
);

$GLOBALS['TCA']['tt_content']['types']['image'] = [
    'showitem' => '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
    --palette--;;general,
    --palette--;;headers,media,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:appearance,
    --palette--;;frames,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
    --palette--;;language, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
    --palette--;;hidden,
    --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes, rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
    ',
    'columnsOverrides' => [
        'media' => [
            'config' => [
                'type' => 'file',
                'allowed' => 'jpg,jpeg,png,webp,svg',
            ],
        ],
    ],
];

$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['image'] = 'content-image';

/**
 * PSI TextImage Element
 */
ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:EXT:psi/Resources/Private/Language/locallang_db.xlf:ctype.textpic',
        'value' => 'textpic',
        'icon' => 'content-beside-text-img-above-center',
        'group' => 'PSI',
        'description' => 'LLL:EXT:psi/Resources/Private/Language/locallang_db.xlf:ctype.textpic.description',
    ]
);

$GLOBALS['TCA']['tt_content']['types']['textpic'] = [
    'showitem' => '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
    --palette--;;general,
    --palette--;;headers, bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:media, assets,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:appearance,
    --palette--;;frames,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
    --palette--;;language, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
    --palette--;;hidden,
    --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes, rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
    ',
    'columnsOverrides' => [
        'bodytext' => [
            'config' => [
                'type' => 'text',
                'cols' => 50,
                'rows' => 5,
                'enableRichtext' => true,
                'richtextConfiguration' => 'default'
            ],
        ],
        'assets' => [
            'config' => [
                'type' => 'file',
                'allowed' => 'jpg,jpeg,png,webp,svg',
            ],
        ],
    ],
];

$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['textpic'] = 'content-beside-text-img-above-center';
