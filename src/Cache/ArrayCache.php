<?php
declare(strict_types = 1);

namespace Src\Cache;

/**
 * Class ArrayCache
 * @package Src
 */
final class ArrayCache
{
    /**
     * @var CacheItem[]
     */
    protected $cache = [];

    /**
     * Wyciągnięcie klucza z pamięci podręcznej.
     *
     * @param $key
     * @return CacheableInterface
     */
    public function getKey(string $key): CacheableInterface
    {
        if (array_key_exists($key, $this->cache)) {
            return $this->cache[$key];
        }

        return new EmptyCacheItem;
    }

    /**
     * Zapisanie klucza do pamięci podręcznej.
     *
     * @param string $key
     * @param CacheItem $cacheItem
     * @return $this
     */
    public function setKey(string $key, CacheItem $cacheItem): ArrayCache
    {
        $this->cache[$key] = $cacheItem;

        return $this;
    }

    /**
     * @param string $key
     * @return ArrayCache
     */
    public function removeKey(string $key): ArrayCache
    {
        if (array_key_exists($key, $this->cache)) {
            unset($this->cache[$key]);
        }

        return $this;
    }
}
