<?php

declare(strict_types=1);

namespace Jacuzzi\Psi\Content;

use Jacuzzi\Psi\Domain\RecordFactory;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Executes a SQL query, and retrieves TCA-based records for Frontend rendering.
 */
class RecordCollector
{
    public function __construct(protected readonly RecordFactory $recordFactory) {}

    public function collect(
        string $table,
        array $select,
        ContentSlideMode $slideMode,
        ContentObjectRenderer $contentObjectRenderer
    ): array {
        $slideCollectReverse = false;
        $collect = false;
        switch ($slideMode) {
            case ContentSlideMode::Slide:
                $slide = true;
                break;
            case ContentSlideMode::Collect:
                $slide = true;
                $collect = true;
                break;
            case ContentSlideMode::CollectReverse:
                $slide = true;
                $collect = true;
                $slideCollectReverse = true;
                break;
            default:
                $slide = false;
        }
        $again = false;
        $totalRecords = [];

        do {
            $recordsOnPid = $contentObjectRenderer->getRecords($table, $select);
            $recordsOnPid = array_map(
                function($record) use ($table) {
                    return $this->recordFactory->createFromDatabaseRecord($table, $record);
                },
                $recordsOnPid
            );

            if ($slideCollectReverse) {
                $totalRecords = array_merge($totalRecords, $recordsOnPid);
            } else {
                $totalRecords = array_merge($recordsOnPid, $totalRecords);
            }
            if ($slide) {
                $select['pidInList'] = $contentObjectRenderer->getSlidePids($select['pidInList'] ?? '', $select['pidInList.'] ?? []);
                if (isset($select['pidInList.'])) {
                    unset($select['pidInList.']);
                }
                $again = $select['pidInList'] !== '';
            }
        } while ($again && $slide && ($recordsOnPid === [] || $collect));
        return $totalRecords;
    }
}
