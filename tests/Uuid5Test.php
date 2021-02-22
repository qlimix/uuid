<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid;

use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Exception\UuidException;
use Qlimix\Id\Uuid\Uuid5;
use ReflectionClass;

final class Uuid5Test extends TestCase
{
    private const Uuid5 = '7dc4ad1c-6990-5ec8-bfb0-825ebfdff565';

    public function testShouldCreateValidObject(): void
    {
        self::assertInstanceOf(Uuid5::class, new Uuid5(self::Uuid5));
    }

    public function testShouldCreateInvalidObject(): void
    {
        $exception = null;
        try {
            new Uuid5('c1c97fa-fc3c-49b-e03-e64075808489');
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }

    public function testShouldCreateSameObjectFromBytes(): void
    {
        $uuid = new Uuid5(self::Uuid5);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid5::fromBytes($bytes);

        self::assertSame($uuid->toString(), $uuidFromBytes->toString());
    }

    public function testShouldCreateSameObjectFromString(): void
    {
        $uuid = new Uuid5(self::Uuid5);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid5::fromBytes($bytes);

        self::assertSame($uuid->toString(), $uuidFromBytes->toString());
        self::assertTrue($uuid->equals($uuidFromBytes));
    }

    public function testShouldEqual(): void
    {
        $uuid = new Uuid5(self::Uuid5);
        $secondUuid = new Uuid5(self::Uuid5);

        self::assertTrue($uuid->equals($secondUuid));
    }

    public function testInvalidFromBytes(): void
    {
        $exception = null;
        try {
            Uuid5::fromBytes("\x00\x01\x02\x03");
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }

    public function testShouldFailOnInvalidHex2BinData(): void
    {
        $uuid5 = new Uuid5(self::Uuid5);
        $reflect = new ReflectionClass($uuid5);
        $property = $reflect->getProperty('uuid5');
        $property->setAccessible(true);
        $property->setValue($uuid5, '1');

        $exception = null;
        try {
            $uuid5->getBytes();
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }
}
