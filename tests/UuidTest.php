<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid;

use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Exception\UuidException;
use Qlimix\Id\Uuid\Uuid;
use ReflectionClass;

final class UuidTest extends TestCase
{
    private const Uuid = 'ecf72764-f657-4ae9-9183-135b72bbad32';

    public function testShouldCreateValidObject(): void
    {
        self::assertInstanceOf(Uuid::class, new Uuid(self::Uuid));
    }

    public function testShouldCreateInvalidObject(): void
    {
        $exception = null;
        try {
            new Uuid('c1c97fa-fc3c-49b-e03-e64075808489');
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }

    public function testShouldCreateSameObjectFromBytes(): void
    {
        $uuid = new Uuid(self::Uuid);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid::fromBytes($bytes);

        self::assertSame($uuid->toString(), $uuidFromBytes->toString());
    }

    public function testShouldCreateSameObjectFromString(): void
    {
        $uuid = new Uuid(self::Uuid);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid::fromBytes($bytes);

        self::assertSame($uuid->toString(), $uuidFromBytes->toString());
        self::assertTrue($uuid->equals($uuidFromBytes));
    }

    public function testShouldEqual(): void
    {
        $uuid = new Uuid(self::Uuid);
        $secondUuid = new Uuid(self::Uuid);

        self::assertTrue($uuid->equals($secondUuid));
    }

    public function testInvalidFromBytes(): void
    {
        $exception = null;
        try {
            Uuid::fromBytes("\x00\x01\x02\x03");
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }

    public function testShouldFailOnInvalidHex2BinData(): void
    {
        $uuid = new Uuid(self::Uuid);
        $reflect = new ReflectionClass($uuid);
        $property = $reflect->getProperty('uuid');
        $property->setAccessible(true);
        $property->setValue($uuid, '1');

        $exception = null;
        try {
            $uuid->getBytes();
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }
}
