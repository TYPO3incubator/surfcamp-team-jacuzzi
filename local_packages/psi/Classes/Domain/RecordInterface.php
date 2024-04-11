<?php

declare(strict_types=1);

namespace Jacuzzi\Psi\Domain;

/**
 * An interface for database / TCA records.
 */
interface RecordInterface
{
    public function getUid(): int;
    public function getPid(): int;
    public function getFullType(): string;
    public function getType(): string;
}
