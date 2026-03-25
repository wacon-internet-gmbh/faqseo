<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 extension: faq_seo.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace Wacon\FaqSeo\Bootstrap\TCA;

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Wacon\FaqSeo\Bootstrap\Base;
use Wacon\FaqSeo\Bootstrap\Traits\TcaTrait;
use Wacon\FaqSeo\Registry\ContentRegistry;

class TtContent extends Base
{
    use TcaTrait;

    protected int $typo3MajorVersion = 13;

    /**
     * Does the main class purpose
     */
    public function invoke()
    {
        $this->dbTable = 'tt_content';
        $this->typo3MajorVersion = GeneralUtility::makeInstance(Typo3Version::class)->getMajorVersion();
        $this->addCTypeFAQ();
        $this->registerPlugins();
    }

    private function addCTypeFAQ(): void
    {
        $key = ContentRegistry::CTYPE_FAQ;

        ExtensionManagementUtility::addTcaSelectItem(
            $this->dbTable,
            'CType',
            [
                'label' => $this->getLLL('locallang_db.xlf:ctype.' . $key),
                'description' => $this->getLLL('locallang_db.xlf:ctype.' . $key . '.description'),
                'value' => $key,
                'group' => 'default',
                'icon' => 'mimetypes-x-content-text-media',
            ]
        );
        $GLOBALS['TCA']['tt_content']['types'][$key] = [
            'showitem' => '
                    --palette--;;general,
                        header;' . $this->getLLL('locallang_tca.xlf:faq.header') . ',
                        header_layout,
                        header_style,
                        bodytext;' . $this->getLLL('locallang_tca.xlf:faq.bodytext') . ',
                    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                        --palette--;;frames,--palette--;;appearanceLinks,
                    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,categories,
                    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                        --palette--;;language,
                    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                        --palette--;;hidden,--palette--;;access,
                    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,rowDescription,
                    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended
                ',
            'columnsOverrides' => [
                'bodytext' => [
                    'config' => [
                        'enableRichtext' => true,
                    ],
                ],
            ],
        ];
        $GLOBALS['TCA'][$this->dbTable]['ctrl']['typeicon_classes'][$key] = 'mimetypes-x-content-text-media';
    }

    /**
     * ExtensionUtility::registerPlugin
     */
    private function registerPlugins(): void
    {
        $pluginSignature = ExtensionUtility::registerPlugin(
            $this->getExtensionKeyAsNamespace(),
            'List',
            $this->getLLL('locallang_plugins.xlf:list.title'),
            'tx-faqseo-svgicon',
            'plugins',
            $this->getLLL('locallang_plugins.xlf:list.description'),
        );

        if ($this->typo3MajorVersion >= 14) {
            ExtensionManagementUtility::addToAllTCAtypes(
                'tt_content',
                '--div--;Configuration,pages,',
                $pluginSignature,
                'after:subheader',
            );
        }
    }
}
