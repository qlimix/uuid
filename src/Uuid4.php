<?php declare(strict_types=1);

namespace Qlimix\Id\Uuid;

use Qlimix\Id\Uuid\Exception\UuidException;
use function hex2bin;
use function implode;
use function preg_match;
use function str_replace;
use function unpack;

final class Uuid4
{
    private const REGEX = '^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-4[0-9A-Fa-f]{3}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$';

    private string $uuid4;

    /**
     * @throws UuidException
     */
    public function __construct(string $uuid)
    {
        $this->guard($uuid);
    }

    /**
     * @throws UuidException
     */
    private function guard(string $uuid): void
    {
        $match = preg_match('~'.self::REGEX.'~', $uuid);
        if ($match === false || $match === 0) {
            throw new UuidException('Invalid uuid');
        }

        $this->uuid4 = $uuid;
    }

    public function equals(self $uuid): bool
    {
        return $this->uuid4 === $uuid->toString();
    }

    /**
     * @throws UuidException
     */
    public function getBytes(): string
    {
        $uuid = str_replace('-', '', $this->uuid4);
        $bin = @hex2bin($uuid);

        if ($bin === false) {
            throw new UuidException('Could not go from hex to bin');
        }

        return $bin;
    }

    public function toString(): string
    {
        return $this->uuid4;
    }

    /**
     * @throws UuidException
     */
    public static function fromBytes(string $bytes): self
    {
        $unpack = @unpack('H8time_low/H4time_mid/H4time_hi/H4clock_seq_hi/H12clock_seq_low', $bytes);
        if ($unpack === false) {
            throw new UuidException('Failed to convert bytes to UUID4');
        }

        return new self(implode('-', $unpack));
    }
}
