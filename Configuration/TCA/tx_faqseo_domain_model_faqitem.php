<?php

declare(strict_types=1);

$tx_faqseo_domain_model_faqitem = new \Wacon\FaqSeo\Bootstrap\TCA\FaqItem();
$tx_faqseo_domain_model_faqitem->invoke();

return $tx_faqseo_domain_model_faqitem->getTCA();
