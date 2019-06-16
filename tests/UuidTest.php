<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid;

use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Exception\UuidException;
use Qlimix\Id\Uuid\Uuid;

final class UuidTest extends TestCase
{
    private const Uuid = 'ecf72764-f657-4ae9-9183-135b72bbad32';

    /**
     * @test
     */
    public function shouldCreateValidObject(): void
    {
        $this->assertInstanceOf(Uuid::class, new Uuid(self::Uuid));
    }

    /**
     * @test
     */
    public function shouldCreateInvalidObject(): void
    {
        $exception = null;
        try {
            new Uuid('c1c97fa-fc3c-49b-e03-e64075808489');
        } catch (UuidException $exception) {
        }

        $this->assertInstanceOf(UuidException::class, $exception);
    }

    /**
     * @test
     */
    public function shouldCreateSameObjectFromBytes(): void
    {
        $uuid = new Uuid(self::Uuid);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid::fromBytes($bytes);

        $this->assertSame($uuid->toString(), $uuidFromBytes->toString());
    }

    /**
     * @test
     */
    public function shouldCreateSameObjectFromString(): void
    {
        $uuid = new Uuid(self::Uuid);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid::fromBytes($bytes);

        $this->assertSame($uuid->toString(), $uuidFromBytes->toString());
        $this->assertTrue($uuid->equals($uuidFromBytes));
    }

    /**
     * @test
     */
    public function shouldEqual(): void
    {
        $uuid = new Uuid(self::Uuid);
        $secondUuid = new Uuid(self::Uuid);

        $this->assertTrue($uuid->equals($secondUuid));
    }
}
