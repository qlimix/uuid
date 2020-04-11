<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid;

use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Exception\UuidException;
use Qlimix\Id\Uuid\Uuid4;

final class Uuid4Test extends TestCase
{
    private const Uuid4 = 'ecf72764-f657-4ae9-9183-135b72bbad32';

    public function testShouldCreateValidObject(): void
    {
        $this->assertInstanceOf(Uuid4::class, new Uuid4(self::Uuid4));
    }

    public function testShouldCreateInvalidObject(): void
    {
        $exception = null;
        try {
            new Uuid4('c1c97fa-fc3c-49b-e03-e64075808489');
        } catch (UuidException $exception) {
        }

        $this->assertInstanceOf(UuidException::class, $exception);
    }

    public function testShouldCreateSameObjectFromBytes(): void
    {
        $uuid = new Uuid4(self::Uuid4);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid4::fromBytes($bytes);

        $this->assertSame($uuid->toString(), $uuidFromBytes->toString());
    }

    public function testShouldCreateSameObjectFromString(): void
    {
        $uuid = new Uuid4(self::Uuid4);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid4::fromBytes($bytes);

        $this->assertSame($uuid->toString(), $uuidFromBytes->toString());
        $this->assertTrue($uuid->equals($uuidFromBytes));
    }

    public function testShouldEqual(): void
    {
        $uuid = new Uuid4(self::Uuid4);
        $secondUuid = new Uuid4(self::Uuid4);

        $this->assertTrue($uuid->equals($secondUuid));
    }
}
