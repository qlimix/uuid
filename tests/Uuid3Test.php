<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid;

use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Exception\UuidException;
use Qlimix\Id\Uuid\Uuid3;

final class Uuid3Test extends TestCase
{
    private const Uuid3 = 'e749d475-12c6-3328-9def-f8b0c9c5ea97';

    public function testShouldCreateValidObject(): void
    {
        self::assertInstanceOf(Uuid3::class, new Uuid3(self::Uuid3));
    }

    public function testShouldCreateInvalidObject(): void
    {
        $exception = null;
        try {
            new Uuid3('c1c97fa-fc3c-49b-e03-e64075808489');
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }

    public function testShouldCreateSameObjectFromBytes(): void
    {
        $uuid = new Uuid3(self::Uuid3);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid3::fromBytes($bytes);

        self::assertSame($uuid->toString(), $uuidFromBytes->toString());
    }

    public function testShouldCreateSameObjectFromString(): void
    {
        $uuid = new Uuid3(self::Uuid3);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid3::fromBytes($bytes);

        self::assertSame($uuid->toString(), $uuidFromBytes->toString());
        self::assertTrue($uuid->equals($uuidFromBytes));
    }

    public function testShouldEqual(): void
    {
        $uuid = new Uuid3(self::Uuid3);
        $secondUuid = new Uuid3(self::Uuid3);

        self::assertTrue($uuid->equals($secondUuid));
    }

    public function testInvalidFromBytes(): void
    {
        $exception = null;
        try {
            Uuid3::fromBytes("\x00\x01\x02\x03");
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }
}
