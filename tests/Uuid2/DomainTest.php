<?php declare(strict_types=1);

namespace Qlimix\Tests\Id\Uuid\Uuid2;

use PHPUnit\Framework\TestCase;
use Qlimix\Id\Uuid\Uuid2\Domain;
use Qlimix\Id\Uuid\Uuid2\Exception\InvalidDomain;

final class DomainTest extends TestCase
{
    public function testShouldDomain(): void
    {
        $person = 0;

        $domain = new Domain($person);

        self::assertSame($person, $domain->toInt());
        self::assertSame((string) $person, $domain->toString());
    }

    public function testShouldDomainPerson(): void
    {
        $domain = Domain::createPerson();

        self::assertSame(0, $domain->toInt());
        self::assertSame('0', $domain->toString());
    }

    public function testShouldDomainGroup(): void
    {
        $domain = Domain::createGroup();

        self::assertSame(1, $domain->toInt());
        self::assertSame('1', $domain->toString());
    }

    public function testShouldDomainOrg(): void
    {
        $domain = Domain::createOrg();

        self::assertSame(2, $domain->toInt());
        self::assertSame('2', $domain->toString());
    }

    public function testShouldThrowOnInvalidDomain(): void
    {
        self::expectException(InvalidDomain::class);
        $domain = new Domain(5);
    }
}
