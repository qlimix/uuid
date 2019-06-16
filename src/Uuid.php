<?php declare(strict_types=1);

namespace Qlimix\Id\UUID;

use Qlimix\Id\UUID\Exception\InvalidUuidException;
use function hex2bin;
use function implode;
use function preg_match;
use function str_replace;
use function unpack;

final class Uuid
{
    private const REGEX = '^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$';

    /** @var string */
    private $uuid;

    /**
     * @throws InvalidUuidException
     */
    public function __construct(string $uuid)
    {
        $this->guard($uuid);
    }

    /**
     * @throws InvalidUuidException
     */
    private function guard(string $uuid): void
    {
        $match = preg_match('~'.self::REGEX.'~', $uuid);
        if ($match === false || $match === 0) {
            throw new InvalidUuidException('Invalid uuid');
        }

        $this->uuid = $uuid;
    }

    public function equals(Uuid $uuid): bool
    {
        return $this->uuid === $uuid->toString();
    }

    public function getBytes(): string
    {
        $uuid = str_replace('-', '', $this->uuid);
        $bin = hex2bin($uuid);

        if ($bin === false) {
            throw new InvalidUuidException('Could not go from hex to bin');
        }

        return $bin;
    }

    public function toString(): string
    {
        return $this->uuid;
    }

    public static function fromBytes(string $bytes): self
    {
        return new Uuid(implode(
            '-',
            unpack('H8time_low/H4time_mid/H4time_hi/H4clock_seq_hi/H12clock_seq_low', $bytes)
        ));
    }
}