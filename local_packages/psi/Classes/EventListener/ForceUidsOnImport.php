<?php

declare(strict_types=1);

namespace Jacuzzi\Psi\EventListener;

use TYPO3\CMS\Core\Attribute\AsEventListener;
use TYPO3\CMS\Impexp\Event\BeforeImportEvent;

/**
 * Event listener used to force uids on importing the basic site data.
 * This is required to have the page ids matching the site configuration, e.g. 404 page.
 */
class ForceUidsOnImport
{
    #[AsEventListener]
    public function __invoke(BeforeImportEvent $event): void
    {
        if (str_ends_with($event->getFile(), 'psi/Initialisation/data.xml')) {
            $event->getImport()->setForceAllUids(true);
        }
    }
}
