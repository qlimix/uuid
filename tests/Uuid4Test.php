<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid;

use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Exception\UuidException;
use Qlimix\Id\Uuid\Uuid4;
use ReflectionClass;

final class Uuid4Test extends TestCase
{
    private const Uuid4 = 'ecf72764-f657-4ae9-9183-135b72bbad32';

    public function testShouldCreateValidObject(): void
    {
        self::assertInstanceOf(Uuid4::class, new Uuid4(self::Uuid4));
    }

    public function testShouldCreateInvalidObject(): void
    {
        $exception = null;
        try {
            new Uuid4('c1c97fa-fc3c-49b-e03-e64075808489');
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }

    public function testShouldCreateSameObjectFromBytes(): void
    {
        $uuid = new Uuid4(self::Uuid4);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid4::fromBytes($bytes);

        self::assertSame($uuid->toString(), $uuidFromBytes->toString());
    }

    public function testShouldCreateSameObjectFromString(): void
    {
        $uuid = new Uuid4(self::Uuid4);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid4::fromBytes($bytes);

        self::assertSame($uuid->toString(), $uuidFromBytes->toString());
        self::assertTrue($uuid->equals($uuidFromBytes));
    }

    public function testShouldEqual(): void
    {
        $uuid = new Uuid4(self::Uuid4);
        $secondUuid = new Uuid4(self::Uuid4);

        self::assertTrue($uuid->equals($secondUuid));
    }

    public function testInvalidFromBytes(): void
    {
        $exception = null;
        try {
            Uuid4::fromBytes("\x00\x01\x02\x03");
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }

    public function testShouldFailOnInvalidHex2BinData(): void
    {
        $uuid4 = new Uuid4(self::Uuid4);
        $reflect = new ReflectionClass($uuid4);
        $property = $reflect->getProperty('uuid4');
        $property->setAccessible(true);
        $property->setValue($uuid4, '1');

        $exception = null;
        try {
            $uuid4->getBytes();
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }
}
