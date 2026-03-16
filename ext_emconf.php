<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'FAQ SEO',
    'description' => 'This extension adds a new content element type "FAQ" to TYPO3, allowing you to create and manage frequently asked questions with enhanced SEO features. It provides a user-friendly interface for content editors to input questions and answers, and it automatically generates structured data (JSON-LD) for improved search engine visibility.',
    'category' => 'plugin',
    'author' => 'Kevin Chileong Lee',
    'author_email' => 'info@wacon.de',
    'author_company' => 'WACON Internet GmbH',
    'state' => 'stable',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-14.4.99',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Wacon\\FaqSeo\\' => 'Classes',
        ],
    ],
];
