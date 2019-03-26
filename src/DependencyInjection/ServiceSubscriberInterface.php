<?php
declare(strict_types = 1);

namespace Src\DependencyInjection;

/**
 * Interface ServiceSubscriberInterface
 * @package Src\DependencyInjection
 */
interface ServiceSubscriberInterface
{
    /**
     * Deklaracja zależności serwisu.
     *
     * @return array
     */
    public static function getSubscribedServices(): array;
}
