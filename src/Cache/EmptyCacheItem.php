<?php
declare(strict_types = 1);

namespace Src\Cache;

/**
 * Class EmptyCacheItem
 * @package Src\Cache
 */
final class EmptyCacheItem implements CacheableInterface
{
    /**
     * @return bool
     */
    public function isHit(): bool
    {
        return false;
    }
}
