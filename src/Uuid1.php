<?php declare(strict_types=1);

namespace Qlimix\Id\Uuid;

use DateTimeImmutable;
use Qlimix\Id\Uuid\Exception\UuidException;
use function base_convert;
use function explode;
use function hex2bin;
use function implode;
use function preg_match;
use function str_replace;
use function substr;
use function unpack;

final class Uuid1
{
    private const REGEX = '^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-1[0-9A-Fa-f]{3}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$';
    private const DIFF_GREGORIAN_EPOCH = 12219292800;
    private const DATETIME_FORMAT = 'Y-m-d H:i:s';
    private const DATETIME_MICRO_SEC_FORMAT = 'Y-m-d H:i:s u';

    private string $uuid1;

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

        $this->uuid1 = $uuid;
    }

    public function equals(self $uuid): bool
    {
        return $this->uuid1 === $uuid->toString();
    }

    /**
     * @throws UuidException
     */
    public function getBytes(): string
    {
        $uuid = str_replace('-', '', $this->uuid1);
        $bin = @hex2bin($uuid);

        if ($bin === false) {
            throw new UuidException('Could not go from hex to bin');
        }

        return $bin;
    }

    public function toString(): string
    {
        return $this->uuid1;
    }

    /**
     * @throws UuidException
     */
    public static function fromBytes(string $bytes): self
    {
        $unpack = @unpack('H8time_low/H4time_mid/H4time_hi/H4clock_seq_hi/H12clock_seq_low', $bytes);
        if ($unpack === false) {
            throw new UuidException('Failed to convert bytes to UUID1');
        }

        return new self(implode('-', $unpack));
    }

    /**
     * @throws UuidException
     */
    public function getDatetime(): DateTimeImmutable
    {
        $explode = explode('-', $this->uuid1);
        $hex = substr($explode[2], 1, 3).$explode[1].$explode[0];

        $gregorian = base_convert($hex, 16, 10);

        $seconds = substr($gregorian, 0, -7);
        $micro = substr($gregorian, -7, 6);

        $epoch = (int) $seconds - self::DIFF_GREGORIAN_EPOCH;

        $datetime = (new DateTimeImmutable())->setTimestamp($epoch);
        $datetimeWithMicro = $datetime->format(self::DATETIME_FORMAT).' '.$micro;

        $createdAt = DateTimeImmutable::createFromFormat(self::DATETIME_MICRO_SEC_FORMAT, $datetimeWithMicro);

        if ($createdAt === false) {
            throw new UuidException('Invalid datetime generated');
        }

        return $createdAt;
    }
}
