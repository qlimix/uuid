<?php declare(strict_types=1);

namespace Qlimix\Id\Uuid\Generator;

use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Uuid4;

interface Uuid4GeneratorInterface
{
    /**
     * @throws UuidGeneratorException
     */
    public function generate(): Uuid4;
}
