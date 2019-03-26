<?php
declare(strict_types = 1);

namespace Src\Cache;

/**
 * Interface CacheableInterface
 * @package Src\Cache
 */
interface CacheableInterface
{
    /**
     * @return bool
     */
    public function isHit(): bool;
}
