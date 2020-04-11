<?php declare(strict_types=1);

namespace Qlimix\Id\Uuid\Generator;

use Qlimix\Id\Uuid\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\Uuid\Uuid2;

interface Uuid2GeneratorInterface
{
    /**
     * @throws UuidGeneratorException
     */
    public function generate(Uuid2\Domain $domain, int $identifier): Uuid2;
}
