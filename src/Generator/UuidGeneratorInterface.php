<?php declare(strict_types=1);

namespace Qlimix\Id\UUID\Generator;

use Qlimix\Id\UUID\Generator\Exception\UuidGeneratorException;
use Qlimix\Id\UUID\Uuid;

interface UuidGeneratorInterface
{
    /**
     * @throws UuidGeneratorException
     */
    public function generate(): Uuid;
}
