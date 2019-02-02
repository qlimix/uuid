<?php declare(strict_types=1);

namespace Qlimix\Id\UUID;

use Qlimix\Id\UUID\Exception\InvalidUUIDException;
use function hex2bin;
use function implode;
use function preg_match;
use function str_replace;
use function unpack;

final class UUID
{
    private const REGEX = '^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$';

    /** @var string */
    private $uuid;

    /**
     * @throws InvalidUUIDException
     */
    public function __construct(string $uuid)
    {
        $this->setUuid($uuid);
    }

    /**
     * @throws InvalidUUIDException
     */
    private function setUuid(string $uuid): void
    {
        $match = preg_match('~'.self::REGEX.'~', $uuid);
        if ($match === false || $match === 0) {
            throw new InvalidUUIDException('Invalid uuid');
        }

        $this->uuid = $uuid;
    }

    public function equals(UUID $uuid): bool
    {
        return $this->uuid === $uuid->toString();
    }

    public function getBytes(): string
    {
        return hex2bin(str_replace('-', '', $this->uuid));
    }

    public function toString(): string
    {
        return $this->uuid;
    }

    public static function fromBytes(string $bytes): self
    {
        return new UUID(implode(
            '-',
            unpack('H8time_low/H4time_mid/H4time_hi/H4clock_seq_hi/H12clock_seq_low', $bytes)
        ));
    }
}
