<?php

$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
$signalSlotDispatcher->connect(
   \GeorgRinger\News\Controller\NewsController::class,
    'detailAction',
    \GeorgRinger\NewsCategoryPidConstraint\Event\PidConstraintEvent::class,
    'connectSignalSlot',
    TRUE
);