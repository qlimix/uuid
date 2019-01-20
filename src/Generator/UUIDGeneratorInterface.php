<?php declare(strict_types=1);

namespace Qlimix\Id\UUID\Generator;

use Qlimix\Id\UUID\Generator\Exception\UUIDGeneratorException;
use Qlimix\Id\UUID\UUID;

interface UUIDGeneratorInterface
{
    /**
     * @return UUID
     *
     * @throws UUIDGeneratorException
     */
    public function generate(): UUID;
}
