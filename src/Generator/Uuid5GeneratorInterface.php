<?php declare(strict_types=1);

namespace Qlimix\Id\Uuid\Generator;

use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Uuid5;

interface Uuid5GeneratorInterface
{
    /**
     * @throws UuidGeneratorException
     */
    public function generate(): Uuid5;
}
