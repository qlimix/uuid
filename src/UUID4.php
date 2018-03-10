<?php declare(strict_types=1);

namespace Qlimix\Id\Generator\UUID;

final class UUID4
{
    private const REGEX = '^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$';

    /** @var string */
    private $uuid4;

    /**
     * @param string $uuid4
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $uuid4)
    {
        $this->setUuid4($uuid4);
    }

    /**
     * @param string $uuid4
     *
     * @throws \InvalidArgumentException
     */
    private function setUuid4(string $uuid4): void
    {
        if (preg_match('~'.self::REGEX.'~', $uuid4) === false) {
            throw new \InvalidArgumentException('Invalid uuid');
        }
        $this->uuid4 = $uuid4;
    }

    /**
     * @return string
     */
    public function getUuid4(): string
    {
        return $this->uuid4;
    }
}
