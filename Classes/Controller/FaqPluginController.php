<?php

declare(strict_types=1);

namespace Wacon\FaqSeo\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Wacon\FaqSeo\Bootstrap\Traits\ExtensionTrait;
use Wacon\FaqSeo\Domain\Repository\FaqitemRepository;

class FaqPluginController extends ActionController
{
    use ExtensionTrait;

    public function __construct(
        protected readonly FaqitemRepository $faqItemRepository,
    ) {}

    /**
     * Show a list of faq records of selected page or folder
     * @param array $uploadForm
     * @return ResponseInterface
     */
    public function listAction(): ResponseInterface
    {
        $data = $this->request->getAttribute('currentContentObject')->data;
        $faqs = $this->faqItemRepository->findAll();

        $this->view->assign('faqs', $faqs);
        $this->view->assign('data', $data);
        return $this->htmlResponse();
    }
}
