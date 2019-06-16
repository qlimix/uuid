<?php declare(strict_types=1);

namespace Qlimix\Id\Uuid\Generator;

use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Uuid;

interface UuidGeneratorInterface
{
    /**
     * @throws UuidGeneratorException
     */
    public function generate(): Uuid;
}
