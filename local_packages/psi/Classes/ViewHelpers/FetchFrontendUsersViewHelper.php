<?php

namespace Jacuzzi\Psi\ViewHelpers;

use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
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
        $userId = $context->getPropertyFromAspect('frontend.user', 'id');
        foreach ($users as $key => $user) {
            if ($user['uid'] === $userId) {
                unset($users[$key]);
            }
            if ($user['image'] > 0) {
                $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_file_reference');
                $media = $queryBuilder
                    ->select('file.*')
                    ->from('sys_file_reference', 'relation')
                    ->leftJoin('relation', 'sys_file', 'file', 'relation.uid_local = file.uid')
                    ->where(
                        $queryBuilder->expr()->eq('relation.uid_foreign', $queryBuilder->createNamedParameter($user['uid']))
                    )
                    ->andWhere(
                        $queryBuilder->expr()->eq('relation.tableNames', $queryBuilder->createNamedParameter('fe_users'))
                    )
                    ->andWhere(
                        $queryBuilder->expr()->eq('relation.deleted', $queryBuilder->createNamedParameter(0))
                    )
                    ->executeQuery()
                    ->fetchAssociative();
                $users[$key]['media'] = '/fileadmin' . $media['identifier'];
            }
        }
        return $users;
    }
}
