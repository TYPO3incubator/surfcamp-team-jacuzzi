<?php

namespace Jacuzzi\Psi\ViewHelpers;

use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Resource\FileCollector;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

final class FetchFrontendUsersViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('pid', 'int', 'Page ID', true);
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $pid = (int)$arguments['pid'];
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('fe_users');

        $query = $queryBuilder
            ->select('*')
            ->from('fe_users')
            ->where(
                $queryBuilder->expr()->eq('pid', $queryBuilder->createNamedParameter($pid))
            )
            ->executeQuery();

        $users = $query->fetchAllAssociative();
        $context = GeneralUtility::makeInstance(Context::class);
        $userId = (int)$context->getPropertyFromAspect('frontend.user', 'id');
        foreach ($users as $key => $user) {
            if ((int)$user['uid'] === $userId) {
                unset($users[$key]);
                continue;
            }
            if ($user['image'] > 0) {
                $fileCollector = GeneralUtility::makeInstance(FileCollector::class);
                $fileCollector->addFilesFromRelation('fe_users', 'image', $user);
                if (count($files = $fileCollector->getFiles()) > 0) {
                    $users[$key]['media'] = reset($files);
                }
            }
        }
        return $users;
    }
}
