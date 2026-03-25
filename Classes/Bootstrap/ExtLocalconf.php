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

namespace Wacon\FaqSeo\Bootstrap;

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Wacon\FaqSeo\Bootstrap\Traits\ExtensionTrait;
use Wacon\FaqSeo\Controller\FaqPluginController;

class ExtLocalconf extends Base
{
    use ExtensionTrait;

    /**
     * Does the main class purpose
     */
    public function invoke(): void
    {
        $this->configurePlugins();
    }

    /**
     * ExtensionUtility::configurePlugin
     */
    private function configurePlugins(): void
    {
        ExtensionUtility::configurePlugin(
            $this->getExtensionKeyAsNamespace(),
            'List',
            [
                FaqPluginController::class => 'list',
            ],
            []
        );
    }
}
