<?php

/**
 * Text Element
 */
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
                'richtextConfiguration' => 'default',
            ],
        ],
    ],
];

$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['text'] = 'content-text';

/**
 * Image Element
 */
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
                'allowed' => 'common-image-types',
            ],
        ],
    ],
];

$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['image'] = 'content-image';

/**
 * Register Download Element
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'PSI Download',
        'value' => 'psi_downloads',
        'icon' => 'actions-file-t3d-download',
        'description' => 'Widget that renders multiple Files for Download',
        'group' => 'PSI',
    ],
    '--div--',
    'after'
);

// Configure Download Element
$GLOBALS['TCA']['tt_content']['types']['psi_downloads'] = [
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            --palette--;;header,
            media,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,
         ',
];

/**
 * TextImage Element
 */
$GLOBALS['TCA']['tt_content']['types']['textpic'] = [
    'showitem' => '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
    --palette--;;general,
    --palette--;;headers, bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,link,
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
                'required' => true,
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
            ],
        ],
        'assets' => [
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
                'minitems' => 1,
                'maxitems' => 1,

                'overrideChildTca' => [
                    'types' => [
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '
                        title, alternative, description,crop,
                        --palette--;;filePalette',
                        ],
                    ],
                ],
            ],
        ],
    ],
];

$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['textpic'] = 'content-beside-text-img-above-center';
