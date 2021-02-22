<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid;

use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Exception\UuidException;
use Qlimix\Id\Uuid\Uuid1;
use ReflectionClass;
use function var_dump;

final class Uuid1Test extends TestCase
{
    private const Uuid1 = '0dbbb434-7bd2-11ea-bc55-0242ac130003';

    public function testShouldCreateValidObject(): void
    {
        self::assertInstanceOf(Uuid1::class, new Uuid1(self::Uuid1));
    }

    public function testShouldCreateInvalidObject(): void
    {
        $exception = null;
        try {
            new Uuid1('c1c97fa-fc3c-49b-e03-e64075808489');
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }

    public function testShouldCreateSameObjectFromBytes(): void
    {
        $uuid = new Uuid1(self::Uuid1);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid1::fromBytes($bytes);

        self::assertSame($uuid->toString(), $uuidFromBytes->toString());
    }

    public function testShouldCreateSameObjectFromString(): void
    {
        $uuid = new Uuid1(self::Uuid1);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid1::fromBytes($bytes);

        self::assertSame($uuid->toString(), $uuidFromBytes->toString());
        self::assertTrue($uuid->equals($uuidFromBytes));
    }

    public function testShouldEqual(): void
    {
        $uuid = new Uuid1(self::Uuid1);
        $secondUuid = new Uuid1(self::Uuid1);

        self::assertTrue($uuid->equals($secondUuid));
    }

    public function testShouldReturnDateTime(): void
    {
        $uuid1 = new Uuid1('0dbbb434-7bd2-11ea-bc55-0242ac130003');

        $datetime = $uuid1->getDatetime();

        self::assertSame('2020-04-11 08:54:29.197522', $datetime->format('Y-m-d H:i:s.u'));
    }

    public function testInvalidFromBytes(): void
    {
        $exception = null;
        try {
            Uuid1::fromBytes("\x00\x01\x02\x03");
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }

    public function testShouldFailOnInvalidHex2BinData(): void
    {
        $uuid1 = new Uuid1(self::Uuid1);
        $reflect = new ReflectionClass($uuid1);
        $property = $reflect->getProperty('uuid1');
        $property->setAccessible(true);
        $property->setValue($uuid1, '1');

        $exception = null;
        try {
            $uuid1->getBytes();
        } catch (UuidException $exception) {
        }

        self::assertInstanceOf(UuidException::class, $exception);
    }
}
