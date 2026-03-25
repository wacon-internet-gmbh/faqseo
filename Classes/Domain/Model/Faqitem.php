<?php

declare(strict_types=1);

namespace Wacon\FaqSeo\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Faqitem extends AbstractEntity
{
    /**
     * Summary of question
     * @var string
     */
    protected string $question = '';

    /**
     * Summary of answer
     * @var string
     */
    protected string $answer = '';

    /**
     * Get summary of question
     *
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * Set summary of question
     *
     * @param string  $question
     *
     * @return self
     */
    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get summary of answer
     *
     * @return string
     */
    public function getAnswer(): string
    {
        return $this->answer;
    }

    /**
     * Set summary of answer
     *
     * @param string  $answer
     *
     * @return self
     */
    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Return FAQ as array for tt_content record
     * @return array
     */
    public function getTtContentData(): array
    {
        return [
            'uid' => $this->getUid(),
            'header' => $this->getQuestion(),
            'bodytext' => $this->getAnswer(),
        ];
    }
}
