<?php declare(strict_types=1);

namespace Qlimix\Id\UUID;

interface UUID
{
    private const REGEX = '^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$';

    public function equals(UUID $uuid): bool;

    public function getBytes(): string;

    public function toString(): string;
}
