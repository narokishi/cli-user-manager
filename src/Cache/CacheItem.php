<?php
declare(strict_types = 1);

namespace Src\Cache;

/**
 * Class CacheItem
 * @package Src\Cache
 */
final class CacheItem implements CacheableInterface
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * Czas życia pakietu (TTL - Time to Live).
     * Zero oznacza czas życia permanentny.
     *
     * @var int
     */
    protected $ttl;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * CacheItem constructor.
     *
     * @param mixed $value
     * @param int $ttl
     */
    public function __construct($value, int $ttl = 0)
    {
        $this->value = $value;
        $this->ttl = $ttl;
        $this->createdAt = new \DateTime;
    }

    /**
     * Zwraca czy element z pamięci podręcznej został "trafiony".
     * Jeżeli element nie jest trafiony to musimy zrewalidować cache pod tym kluczem.
     *
     * @return bool
     */
    public function isHit(): bool
    {
        if ($this->ttl === 0) {
            return true;
        }

        return $this->createdAt->diff(new \DateTime)->s < $this->ttl;
    }
}
