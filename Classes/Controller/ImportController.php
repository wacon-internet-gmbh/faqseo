<?php

declare(strict_types=1);

namespace Wacon\FaqSeo\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Backend\Attribute\AsController;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use Wacon\FaqSeo\Bootstrap\Traits\ExtensionTrait;
use Wacon\FaqSeo\Domain\Model\Faqitem;
use Wacon\FaqSeo\Domain\Repository\FaqitemRepository;
use Wacon\FaqSeo\FileReader\CsvAndXlsxReader;

#[AsController]
final class ImportController extends ActionController
{
    use ExtensionTrait;

    public function __construct(
        protected readonly ModuleTemplateFactory $moduleTemplateFactory,
        protected readonly CsvAndXlsxReader $csvAndXlsxReader,
        protected readonly FaqitemRepository $faqItemRepository
    ) {}

    /**
     * Show upload form
     * @param array $uploadForm
     * @return ResponseInterface
     */
    public function uploadFormAction(array $uploadForm = []): ResponseInterface
    {
        $moduleTemplate = $this->moduleTemplateFactory->create($this->request);
        $moduleTemplate->assign('selectedPageId', $this->request->getQueryParams()['id'] ?? null);
        $moduleTemplate->assign('uploadForm', $uploadForm);
        return $moduleTemplate->renderResponse('ImportController/UploadForm');
    }

    /**
     * Import FAQ items from uploaded file and redirect to upload form with success or error message
     * @throws \InvalidArgumentException
     * @return ResponseInterface
     */
    public function importAction(array $uploadForm): ResponseInterface
    {
        if ($this->request->getQueryParams()['id'] === null) {
            throw new \InvalidArgumentException('Missing page id', time());
        }

        $lines = $this->csvAndXlsxReader->parseFile($uploadForm['csvFile'], ['separator' => ',']);
        $firstLine = current($lines);
        if (empty($lines) || empty($firstLine[0])) {
            $this->addFlashMessage(LocalizationUtility::translate('backend.module.import.error.empty_file', $this->extensionKey), '', ContextualFeedbackSeverity::ERROR);
            return $this->redirect('uploadForm', null, null, ['id' => $this->request->getQueryParams()['id']]);
        }

        foreach($lines as $key => $line) {
            if ($uploadForm['skipFirstRow'] && $key == 0) {
                continue;
            }

            $this->importRow($line);
        }

        return $this->redirect('uploadForm', null, null, ['id' => $this->request->getQueryParams()['id']]);
    }

    /**
     * Import row from uploaded file and save it to database
     * @param array $row
     */
    private function importRow(array $row): void
    {
        $faqItem = new Faqitem();
        $faqItem->setQuestion($row[0] ?? '');
        $faqItem->setAnswer($row[1] ?? '');
        $faqItem->setPid((int)$this->request->getQueryParams()['id']);
        $this->faqItemRepository->add($faqItem);
    }
}
