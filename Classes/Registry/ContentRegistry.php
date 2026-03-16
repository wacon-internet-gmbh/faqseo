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

namespace Wacon\FaqSeo\Registry;

use TYPO3\CMS\Core\SingletonInterface;

class ContentRegistry implements SingletonInterface
{
    public const CTYPE_FAQ = 'faqseo_faq';
}
