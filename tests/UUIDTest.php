<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid;

use PHPUnit\Framework\TestCase;
use Qlimix\Id\UUID\Exception\InvalidUUIDException;
use Qlimix\Id\UUID\UUID;

final class UUIDTest extends TestCase
{
    private const UUID = 'ecf72764-f657-4ae9-9183-135b72bbad32';

    /**
     * @test
     */
    public function shouldCreateValidObject(): void
    {
        $this->assertInstanceOf(UUID::class, new UUID(self::UUID));
    }

    /**
     * @test
     */
    public function shouldCreateInvalidObject(): void
    {
        $exception = null;
        try {
            new UUID('c1c97fa-fc3c-49b-e03-e64075808489');
        } catch (InvalidUUIDException $exception) {
        }

        $this->assertInstanceOf(InvalidUUIDException::class, $exception);
    }

    /**
     * @test
     */
    public function shouldCreateSameObjectFromBytes(): void
    {
        $uuid = new UUID(self::UUID);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = UUID::fromBytes($bytes);

        $this->assertSame($uuid->toString(), $uuidFromBytes->toString());
    }

    /**
     * @test
     */
    public function shouldCreateSameObjectFromString(): void
    {
        $uuid = new UUID(self::UUID);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = UUID::fromBytes($bytes);

        $this->assertSame($uuid->toString(), $uuidFromBytes->toString());
        $this->assertTrue($uuid->equals($uuidFromBytes));
    }

    /**
     * @test
     */
    public function shouldEqual(): void
    {
        $uuid = new UUID(self::UUID);
        $secondUuid = new UUID(self::UUID);

        $this->assertTrue($uuid->equals($secondUuid));
    }
}
