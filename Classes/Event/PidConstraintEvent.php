<?php
declare(strict_types=1);

namespace GeorgRinger\NewsCategoryPidConstraint\Event;

use GeorgRinger\News\Domain\Model\Dto\NewsDemand;
use GeorgRinger\News\Domain\Model\News;
use GeorgRinger\News\Event\NewsDetailActionEvent;
use TYPO3\CMS\Core\Http\ImmediateResponseException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Controller\ErrorController;

final class PidConstraintEvent
{

    /**
     * Implementation for news 9
     *
     * @param NewsDetailActionEvent $event
     * @return void
     */
    public function connect(NewsDetailActionEvent $event): void
    {
        $assignedValues = $event->getAssignedValues();
        if (!$this->isValid($assignedValues['newsItem'])) {
            if ($assignedValues['settings']['news_category_pid_constraint']['pageNotFoundError'] ?? false) {
                $this->throwPageNotFoundError();
            }
            $assignedValues['newsItem'] = null;
        }
        $event->setAssignedValues($assignedValues);
    }

    /**
     * Implementation for news 8
     *
     * @param News $news
     * @param int $currentPage
     * @param NewsDemand $demand
     * @param array $settings
     * @param $fo
     * @return array
     */
    public function connectSignalSlot(News $news, int $currentPage, NewsDemand $demand, array $settings, $fo)
    {
        $returnArguments = [
            'newsItem' => $news,
            'currentPage' => $currentPage,
            'demand' => $demand,
            'settings' => $settings,
            'extendedVariables' => []
        ];
        if (!$this->isValid($news)) {
            if ($settings['news_category_pid_constraint']['pageNotFoundError'] ?? false) {
                $this->throwPageNotFoundError();
            }
            $returnArguments['newsItem'] = null;
        }
        return $returnArguments;
    }

    protected function throwPageNotFoundError(): void
    {
        $message = 'Detail page is invalid for this news category!';
        $response = GeneralUtility::makeInstance(ErrorController::class)->pageNotFoundAction(
            $GLOBALS['TYPO3_REQUEST'],
            $message
        );
        throw new ImmediateResponseException($response, 1590468229);
    }

    protected function isValid(News $news): bool
    {
        $firstCategory = $news->getFirstCategory();
        if (!$firstCategory) {
            return true;
        }
        $singlePage = $firstCategory->getSinglePid();
        if (!$singlePage) {
            return true;
        }

        return $GLOBALS['TSFE']->id === $singlePage;
    }

}