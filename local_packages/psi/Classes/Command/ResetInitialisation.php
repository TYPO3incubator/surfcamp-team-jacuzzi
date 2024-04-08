<?php

declare(strict_types=1);

namespace Jacuzzi\Psi\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use TYPO3\CMS\Core\Database\ConnectionPool;

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
                $queryBuilder->expr()->like('entry_key', $queryBuilder->createNamedParameter('%jacuzzi/psi%'))
            )
            ->executeStatement();

        (new SymfonyStyle($input, $output))->info('Removed ' . $count . ' records.');

        return 0;
    }
}
