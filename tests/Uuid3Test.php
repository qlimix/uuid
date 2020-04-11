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
        $this->assertInstanceOf(Uuid3::class, new Uuid3(self::Uuid3));
    }

    public function testShouldCreateInvalidObject(): void
    {
        $exception = null;
        try {
            new Uuid3('c1c97fa-fc3c-49b-e03-e64075808489');
        } catch (UuidException $exception) {
        }

        $this->assertInstanceOf(UuidException::class, $exception);
    }

    public function testShouldCreateSameObjectFromBytes(): void
    {
        $uuid = new Uuid3(self::Uuid3);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid3::fromBytes($bytes);

        $this->assertSame($uuid->toString(), $uuidFromBytes->toString());
    }

    public function testShouldCreateSameObjectFromString(): void
    {
        $uuid = new Uuid3(self::Uuid3);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid3::fromBytes($bytes);

        $this->assertSame($uuid->toString(), $uuidFromBytes->toString());
        $this->assertTrue($uuid->equals($uuidFromBytes));
    }

    public function testShouldEqual(): void
    {
        $uuid = new Uuid3(self::Uuid3);
        $secondUuid = new Uuid3(self::Uuid3);

        $this->assertTrue($uuid->equals($secondUuid));
    }
}
