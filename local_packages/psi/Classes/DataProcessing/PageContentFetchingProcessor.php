<?php

declare(strict_types=1);

namespace Jacuzzi\Psi\DataProcessing;

use Jacuzzi\Psi\Content\ContentSlideMode;
use Jacuzzi\Psi\Content\RecordCollector;
use Jacuzzi\Psi\Content\RecordEnricher;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use TYPO3\CMS\Core\Page\PageLayoutResolver;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\ContentObject\DataProcessorInterface;

/**
 * All-in-one data processor that loads all content from the current page layout into
 * the template with a given identifier for each colPos, also respecting slideMode or
 * collect options based on the page layouts content columns.
 */
#[AutoconfigureTag('data.processor', ['identifier' => 'pageContent'])]
class PageContentFetchingProcessor implements DataProcessorInterface
{
    public function __construct(
        protected readonly RecordCollector $contentCollector,
        protected readonly RecordEnricher $recordEnricher,
        protected readonly PageLayoutResolver $pageLayoutResolver,
    ) {}

    public function process(
        ContentObjectRenderer $cObj,
        array $contentObjectConfiguration,
        array $processorConfiguration,
        array $processedData
    ): array {
        if (isset($processorConfiguration['if.']) && !$cObj->checkIf($processorConfiguration['if.'])) {
            return $processedData;
        }
        $pageInformation = $cObj->getRequest()->getAttribute('frontend.page.information');
        $pageLayout = $this->pageLayoutResolver->getLayoutForPage(
            $pageInformation->getPageRecord(),
            $pageInformation->getRootLine()
        );

        $targetVariableName = $cObj->stdWrapValue('as', $processorConfiguration, 'content');
        foreach ($pageLayout?->getContentAreas() as $contentAreaData) {
            if (!isset($contentAreaData['colPos'])) {
                continue;
            }
            // Find automated information from TCA
            $items = $this->contentCollector->collect(
                'tt_content',
                [
                    'where' => 'colPos=' . (int)$contentAreaData['colPos'],
                    'orderBy' => 'sorting',
                ],
                ContentSlideMode::tryFrom($contentAreaData['slideMode'] ?? null),
                $cObj,
            );
            if ($processorConfiguration['enrich'] ?? true) {
                $items = array_map(fn ($item) => $this->recordEnricher->createResolvedRecordFromRecord($item), $items);
            }
            $contentAreaData['blocks'] = $items;
            $contentAreaName = $contentAreaData['identifier'] ?? 'column' . $contentAreaData['colPos'];
            $processedData[$targetVariableName][$contentAreaName] = $contentAreaData;
        }
        return $processedData;
    }
}
