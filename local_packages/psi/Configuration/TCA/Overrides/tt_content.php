<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

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

/**
 * CType: Employee List
 */

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'label' => 'LLL:EXT:psi/Resources/Private/Language/locallang_db.xlf:tt_content.ctype.employee_list',
        'value' => 'employee_list',
        'icon' => 'apps-pagetree-folder-contains-fe_users',
        'group' => 'special',
        'description' => 'LLL:EXT:psi/Resources/Private/Language/locallang_db.xlf:tt_content.ctype.employee_list.description',
    ]
);

$GLOBALS['TCA']['tt_content']['types']['employee_list'] = [
    'showitem' =>
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            --palette--;;general,
            header,
            pages,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,',
    'columnsOverrides' => [
        'pages'    => [
            'config'  => [
                'size'  => 1,
            ],
        ],
    ],
];


$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['employee_list'] = 'apps-pagetree-folder-contains-fe_users';
