<?php

declare(strict_types=1);

namespace Jacuzzi\Psi\Content;

enum ContentSlideMode
{
    case None;
    case Slide;
    case Collect;
    case CollectReverse;

    public static function tryFrom(?string $slideMode): ContentSlideMode
    {
        return match ($slideMode) {
            'slide' => self::Slide,
            'collect' => self::Collect,
            'collectReverse' => self::CollectReverse,
            default => self::None,
        };
    }
}
