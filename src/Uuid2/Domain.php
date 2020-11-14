<?php declare(strict_types=1);

namespace Qlimix\Id\Uuid\Uuid2;

use Qlimix\Id\Uuid\Uuid2\Exception\InvalidDomain;
use function in_array;

final class Domain
{
    private const PERSON = 0;
    private const GROUP = 1;
    private const ORG = 2;

    private const DOMAINS = [
        self::PERSON,
        self::GROUP,
        self::ORG,
    ];

    private int $domain;

    /**
     * @throws InvalidDomain
     */
    public function __construct(int $domain)
    {
        $this->guard($domain);
    }

    /**
     * @throws InvalidDomain
     */
    private function guard(int $domain): void
    {
        if (!in_array($domain, self::DOMAINS, true)) {
            throw new InvalidDomain('Invalid domain: '.$domain);
        }

        $this->domain = $domain;
    }

    public function equals(self $domain): bool
    {
        return $domain->toInt() === $this->domain;
    }

    public static function createPerson(): self
    {
        return new self(self::PERSON);
    }

    public static function createGroup(): self
    {
        return new self(self::GROUP);
    }

    public static function createOrg(): self
    {
        return new self(self::ORG);
    }

    public function toInt(): int
    {
        return $this->domain;
    }

    public function toString(): string
    {
        return (string) $this->domain;
    }
}
