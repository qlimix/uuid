<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid;

use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Exception\UuidException;
use Qlimix\Id\Uuid\Uuid1;

final class Uuid1Test extends TestCase
{
    private const Uuid1 = '0dbbb434-7bd2-11ea-bc55-0242ac130003';

    public function testShouldCreateValidObject(): void
    {
        $this->assertInstanceOf(Uuid1::class, new Uuid1(self::Uuid1));
    }

    public function testShouldCreateInvalidObject(): void
    {
        $exception = null;
        try {
            new Uuid1('c1c97fa-fc3c-49b-e03-e64075808489');
        } catch (UuidException $exception) {
        }

        $this->assertInstanceOf(UuidException::class, $exception);
    }

    public function testShouldCreateSameObjectFromBytes(): void
    {
        $uuid = new Uuid1(self::Uuid1);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid1::fromBytes($bytes);

        $this->assertSame($uuid->toString(), $uuidFromBytes->toString());
    }

    public function testShouldCreateSameObjectFromString(): void
    {
        $uuid = new Uuid1(self::Uuid1);
        $bytes = $uuid->getBytes();
        $uuidFromBytes = Uuid1::fromBytes($bytes);

        $this->assertSame($uuid->toString(), $uuidFromBytes->toString());
        $this->assertTrue($uuid->equals($uuidFromBytes));
    }

    public function testShouldEqual(): void
    {
        $uuid = new Uuid1(self::Uuid1);
        $secondUuid = new Uuid1(self::Uuid1);

        $this->assertTrue($uuid->equals($secondUuid));
    }

    public function testShouldReturnDateTime(): void
    {
        $uuid1 = new Uuid1('0dbbb434-7bd2-11ea-bc55-0242ac130003');

        $datetime = $uuid1->getDatetime();

        $this->assertSame('2020-04-11 08:54:29.197522', $datetime->format('Y-m-d H:i:s.u'));
    }
}
