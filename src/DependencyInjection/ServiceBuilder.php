<?php
declare(strict_types = 1);

namespace Src\DependencyInjection;

/**
 * Class ServiceBuilder
 * @package Src\DependencyInjection
 */
final class ServiceBuilder
{
    /**
     * Buduje klasę serwisu w kontenerze.
     *
     * @param string $serviceClass
     * @param Container $serviceContainer
     * @return mixed
     */
    public static function buildService(string $serviceClass, Container $serviceContainer)
    {
        $service = $serviceContainer->getRegisteredService($serviceClass)($serviceContainer);

        $serviceContainer->addService($serviceClass, $service);

        return $service;
    }
}
