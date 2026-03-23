<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 extension faq_sep.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Wacon\FaqSeo\ViewHelpers\StructuredData;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use Wacon\FaqSeo\Bootstrap\Traits\ExtensionTrait;

final class FaqViewHelper extends AbstractViewHelper
{
    use ExtensionTrait;

    protected $escapeChildren = false;

    public function initializeArguments(): void
    {
        $this->registerArgument(
            'items',
            'array',
            'FAQ Items',
            false,
            []
        );
        $this->registerArgument(
            'item',
            'array',
            'FAQ Item',
            false,
            []
        );
    }

    public function render(): string
    {
        $items = $this->arguments['items'] ?? [];

        if (empty($items) && !empty($this->arguments['item'])) {
            $items = [$this->arguments['item']];
        }

        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => [],
        ];

        foreach ($items as $item) {
            $structuredData['mainEntity'][] = [
                '@type' => 'Question',
                'name' => $item['header'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => \strip_tags($item['bodytext']),
                ],
            ];
        }
        return \json_encode($structuredData, JSON_HEX_TAG);
    }
}
