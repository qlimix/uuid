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

        $this->assertSame($person, $domain->toInt());
        $this->assertSame((string) $person, $domain->toString());
    }

    public function testShouldDomainPerson(): void
    {
        $domain = Domain::createPerson();

        $this->assertSame(0, $domain->toInt());
        $this->assertSame('0', $domain->toString());
    }

    public function testShouldDomainGroup(): void
    {
        $domain = Domain::createGroup();

        $this->assertSame(1, $domain->toInt());
        $this->assertSame('1', $domain->toString());
    }

    public function testShouldDomainOrg(): void
    {
        $domain = Domain::createOrg();

        $this->assertSame(2, $domain->toInt());
        $this->assertSame('2', $domain->toString());
    }

    public function testShouldThrowOnInvalidDomain(): void
    {
        $this->expectException(InvalidDomain::class);
        $domain = new Domain(5);
    }
}
