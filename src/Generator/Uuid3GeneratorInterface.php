<?php declare(strict_types=1);

namespace Qlimix\Id\Uuid\Generator;

use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Uuid;
use Qlimix\Id\Uuid\Uuid3;

interface Uuid3GeneratorInterface
{
    /**
     * @throws UuidGeneratorException
     */
    public function generate(Uuid $namespace, string $name): Uuid3;
}
