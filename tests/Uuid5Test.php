<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid;

use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Exception\UuidException;
use Qlimix\Id\Uuid\Uuid5;

final class Uuid5Test extends TestCase
{
    private const Uuid5 = '7dc4ad1c-6990-5ec8-bfb0-825ebfdff565';

    public function testShouldCreateValidObject(): void
    {
        $this->assertInstanceOf(Uuid5::class, new Uuid5(self::Uuid5));
    }

    public function testShouldCreateInvalidObject(): void
    {
        $exception = null;
        try {
            new Uuid5('c1c97fa-fc3c-49b-e03-e64075808489');
        } catch (UuidException $exception) {
        }

        $this->assertInstanceOf(UuidException::class, $exception);
    }

    public function testShouldCreateSameObjectFromBytes(): void
    {
        $uuid = new Uuid5(self::Uuid5);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid5::fromBytes($bytes);

        $this->assertSame($uuid->toString(), $uuidFromBytes->toString());
    }

    public function testShouldCreateSameObjectFromString(): void
    {
        $uuid = new Uuid5(self::Uuid5);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid5::fromBytes($bytes);

        $this->assertSame($uuid->toString(), $uuidFromBytes->toString());
        $this->assertTrue($uuid->equals($uuidFromBytes));
    }

    public function testShouldEqual(): void
    {
        $uuid = new Uuid5(self::Uuid5);
        $secondUuid = new Uuid5(self::Uuid5);

        $this->assertTrue($uuid->equals($secondUuid));
    }
}
