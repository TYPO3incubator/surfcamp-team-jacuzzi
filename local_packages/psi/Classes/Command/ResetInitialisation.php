<?php

declare(strict_types=1);

namespace Jacuzzi\Psi\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

#[AsCommand(
    name: 'psi:reset-initialisation',
    description: 'Resets the initialisation state of psi in sys_registry',
)]
class ResetInitialisation extends Command
{
    public function __construct(
        private readonly ConnectionPool $connectionPool
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $queryBuilder = $this->connectionPool->getQueryBuilderForTable('sys_registry');
        $count = $queryBuilder
            ->delete('sys_registry')
            ->where(
                $queryBuilder->expr()->like('entry_namespace', $queryBuilder->createNamedParameter('extensionDataImport')),
                $queryBuilder->expr()->like('entry_key', $queryBuilder->createNamedParameter('%jacuzzi/psi%'))
            )
            ->orWhere(
                $queryBuilder->expr()->like('entry_namespace', $queryBuilder->createNamedParameter('siteConfigImport')),
                $queryBuilder->expr()->like('entry_key', $queryBuilder->createNamedParameter('psi-intranet'))
            )
            ->executeStatement();

        $io = new SymfonyStyle($input, $output);

        if ($count > 0) {
            $io->info('Removed ' . $count . ' records.');
        } else {
            $io->warning('No records to remove found.');
        }

        $directory = Environment::getConfigPath() . '/sites/psi-intranet/';
        if (!GeneralUtility::rmdir($directory, true)) {
            $io->warning('Site configuration could not be removed.');
            return Command::SUCCESS;
        }

        $io->info('Removed site configuration.');

        return Command::SUCCESS;
    }
}
