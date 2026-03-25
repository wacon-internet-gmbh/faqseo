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

use Wacon\FaqSeo\Bootstrap\Base;
use Wacon\FaqSeo\Bootstrap\Traits\ExtensionTrait;
use Wacon\FaqSeo\Bootstrap\Traits\TcaTrait;

class FaqItem extends Base
{
    use ExtensionTrait;
    use TcaTrait;

    public function invoke(): void
    {
        $this->dbTable = 'tx_faqseo_domain_model_faqitem';
    }

    /**
     * Return the TCA array
     * @return array
     */
    public function getTCA(): array
    {
        $tca = [
            'ctrl' => [
                'title' => $this->getLLL('locallang_db.xlf:ctype.faqseo_faq'),
                'label' => 'question',
                'tstamp' => 'tstamp',
                'crdate' => 'crdate',
                'delete' => 'deleted',
                'default_sortby' => 'crdate DESC',
                'iconfile' => $this->getIconPath('Extension.svg'),
                'searchFields' => 'question,answer',
                'languageField' => 'sys_language_uid',
                'enablecolumns' => [
                    'disabled' => 'hidden',
                ],
                'security' => [
                    'ignorePageTypeRestriction' => true,
                ],
            ],
            'palettes' => [
                'general' => $GLOBALS['TCA']['tt_content']['palettes']['general'] ?? [],
                'hidden' => $GLOBALS['TCA']['tt_content']['palettes']['hidden'] ?? [],
                'access' => $GLOBALS['TCA']['tt_content']['palettes']['access'] ?? [],
                'language' => $GLOBALS['TCA']['tt_content']['palettes']['language'] ?? [],
            ],
            'columns' => [
                'hidden' => $this->getHiddenTCADef(),
                'question' => $this->getInputTCADef(false, $this->getLLL('locallang_tca.xlf:faq.header')),
                'answer' => $this->getRTETCADef(false, $this->getLLL('locallang_tca.xlf:faq.bodytext')),
            ],
            'types' => [
                [
                    'showitem' => '
                        --palette--;;general,question,answer,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                            --palette--;;language,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                            --palette--;;hidden,--palette--;;access,
                    ',
                ],
            ],
        ];

        return $tca;
    }
}
