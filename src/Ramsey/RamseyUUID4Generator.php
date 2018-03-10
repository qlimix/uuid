<?php declare(strict_types=1);

namespace Qlimix\Id\Generator\UUID\Ramsey;

use Qlimix\Id\Generator\UUID\Exception\UUID4GeneratorException;
use Qlimix\Id\Generator\UUID\UUID4;
use Qlimix\Id\Generator\UUID\UUID4Generator;
use Ramsey\Uuid\Uuid;

final class RamseyUUID4Generator implements UUID4Generator
{
    /**
     * @inheritDoc
     */
    public function generate(): UUID4
    {
        try {
            return new UUID4(Uuid::uuid4()->toString());
        } catch (\Throwable $exception) {
            throw new UUID4GeneratorException('Could not generate UUID4', 0, $exception);
        }
    }
}
