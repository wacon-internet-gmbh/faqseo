<?php

declare(strict_types=1);

use Wacon\FaqSeo\Controller\ImportController;

return [
    'web_FaqSeoImport' => [
        'labels' => [
            'title' => 'LLL:EXT:faq_seo/Resources/Private/Language/locallang.xlf:backend.module.import.title',
            'description' => 'LLL:EXT:faq_seo/Resources/Private/Language/locallang.xlf:backend.module.import.description',
            'shortDescription' => 'LLL:EXT:faq_seo/Resources/Private/Language/locallang.xlf:backend.module.import.short_description',
        ],
        'path' => '/module/web/FaqSeoImport',
        'iconIdentifier' => 'tx-faqseo-svgicon',
        'controllerActions' => [
            ImportController::class => [
                'uploadForm',
                'import',
            ],
        ],
    ],
];
