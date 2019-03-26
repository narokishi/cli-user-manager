<?php

namespace Src;

use Src\DependencyInjection\ServiceSubscriberInterface;

/**
 * Class PDO
 * @package Src
 */
final class PDO extends \PDO implements ServiceSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedServices(): array
    {
        return [];
    }
}
