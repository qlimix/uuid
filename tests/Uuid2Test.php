<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid;

use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Exception\UuidException;
use Qlimix\Id\Uuid\Uuid2;

final class Uuid2Test extends TestCase
{
    private const Uuid2 = '00000001-7be5-21ea-b700-0242bdf7a111';

    public function testShouldCreateValidObject(): void
    {
        self::assertInstanceOf(Uuid2::class, new Uuid2(self::Uuid2));
    }

    public function testShouldCreateInvalidObject(): void
    {
        $exception = null;
        try {
            new Uuid2('c1c97fa-fc3c-49b-e03-e64075808489');
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }

    public function testShouldCreateSameObjectFromBytes(): void
    {
        $uuid = new Uuid2(self::Uuid2);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid2::fromBytes($bytes);

        self::assertSame($uuid->toString(), $uuidFromBytes->toString());
    }

    public function testShouldCreateSameObjectFromString(): void
    {
        $uuid = new Uuid2(self::Uuid2);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid2::fromBytes($bytes);

        self::assertSame($uuid->toString(), $uuidFromBytes->toString());
        self::assertTrue($uuid->equals($uuidFromBytes));
    }

    public function testShouldEqual(): void
    {
        $uuid = new Uuid2(self::Uuid2);
        $secondUuid = new Uuid2(self::Uuid2);

        self::assertTrue($uuid->equals($secondUuid));
    }

    public function testShouldReturnDomain(): void
    {
        $uuid = new Uuid2(self::Uuid2);

        self::assertTrue(Uuid2\Domain::createPerson()->equals($uuid->getDomain()));
    }

    public function testShouldReturnIdentifier(): void
    {
        $uuid = new Uuid2(self::Uuid2);

        self::assertSame(1, $uuid->getIdentifier());
    }

    public function testInvalidFromBytes(): void
    {
        $exception = null;
        try {
            Uuid2::fromBytes("\x00\x01\x02\x03");
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }
}
