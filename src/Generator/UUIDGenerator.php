<?php declare(strict_types=1);

namespace Qlimix\Id\UUID;

use Qlimix\Id\UUID\Generator\Exception\UUIDGeneratorException;

interface UUIDGenerator
{
    /**
     * @return UUID
     *
     * @throws UUIDGeneratorException
     */
    public function generate(): UUID;
}
