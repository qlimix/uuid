<?php declare(strict_types=1);

namespace Qlimix\Id\Generator\UUID;

use Qlimix\Id\Generator\UUID\Exception\UUID4GeneratorException;

interface UUID4Generator
{
    /**
     * @return UUID4
     *
     * @throws UUID4GeneratorException
     */
    public function generate(): UUID4;
}
