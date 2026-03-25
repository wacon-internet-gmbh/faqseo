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
use Wacon\FaqSeo\Domain\Model\Faqitem;

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
                'name' => $this->getName($item),
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => \strip_tags($this->getText($item)),
                ],
            ];
        }
        return \json_encode($structuredData, JSON_HEX_TAG);
    }

    /**
     * Get name for faq item for structured data
     * @param Faqitem|array $item
     * @return string
     */
    protected function getName($item): string
    {
        if (is_array($item)) {
            return $item['header'] ?? $item['question'] ?? '';
        }

        return get_class($item) === Faqitem::class ? $item->getQuestion() : '';
    }

    /**
     * Get text for faq item for structured data
     * @param Faqitem|array $item
     * @return string
     */
    protected function getText($item): string
    {
        if (is_array($item)) {
            return $item['bodytext'] ?? $item['answer'] ?? '';
        }

        return get_class($item) === Faqitem::class ? $item->getAnswer() : '';
    }
}
