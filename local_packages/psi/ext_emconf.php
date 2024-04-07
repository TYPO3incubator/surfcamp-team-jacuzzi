<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Public Sector Intranet',
    'description' => 'Site package for public sector intranet (psi)',
    'category' => 'distribution',
    'author' => 'Oliver Bartsch',
    'author_email' => 'bo@ceddev.de',
    'state' => 'alpha',
    'version' => '0.0.1',
    'constraints' => [
        'depends' => [
            'typo3' => '13.0.0-13.99.99',
        ],
        'conflicts' => [],
        'suggests' => []
    ],
    'autoload' => [
        'psr-4' => [
            'Jacuzzi\\Psi\\' => 'Classes/',
        ]
    ]
];
