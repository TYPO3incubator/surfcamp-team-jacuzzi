<?php
/**
 * Add new fields to fe_users table
 */

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
$feUserDepartment = [
    'employee_department' => [
        'exclude' => 1,
        'label' => 'Departament',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                ['LLL:EXT:psi/Resources/Private/Language/locallang_db.xlf:fe_users.department.none', '0'],
                ['LLL:EXT:psi/Resources/Private/Language/locallang_db.xlf:fe_users.department.management', '1'],
                ['LLL:EXT:psi/Resources/Private/Language/locallang_db.xlf:fe_users.department.marketing', '2'],
                ['LLL:EXT:psi/Resources/Private/Language/locallang_db.xlf:fe_users.department.legal', '3'],
                ['LLL:EXT:psi/Resources/Private/Language/locallang_db.xlf:fe_users.department.hr', '4'],
                ['LLL:EXT:psi/Resources/Private/Language/locallang_db.xlf:fe_users.department.finance', '5'],
                ['LLL:EXT:psi/Resources/Private/Language/locallang_db.xlf:fe_users.department.it', '6'],
            ],
            'default' => '0',
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns('fe_users', $feUserDepartment);
ExtensionManagementUtility::addToAllTCAtypes('fe_users', 'employee_department', '', 'after: name');
