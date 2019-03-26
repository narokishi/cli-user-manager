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
     * @param string $serviceClass
     * @return bool
     */
    public static function isValidService(string $serviceClass): bool
    {
        return is_subclass_of($serviceClass, ServiceSubscriberInterface::class);
    }

    /**
     * Buduje klasę serwisu w kontenerze.
     *
     * @param string $serviceClass
     * @param Container $serviceContainer
     * @return mixed
     */
    public static function buildService(string $serviceClass, Container $serviceContainer): ServiceSubscriberInterface
    {
        if (!self::isValidService($serviceClass)) {
            throw new RegisterServiceException($serviceClass);
        }

        $dependencies = [];

        /** @var ServiceSubscriberInterface $serviceClass */
        foreach ($serviceClass::getSubscribedServices() as $dependency) {
            if (!self::isValidService($dependency)) {
                throw new RegisterServiceException($dependency);
            }

            $dependencies[] = $serviceContainer->getService($dependency);
        }

        $service = new $serviceClass(...$dependencies);
        $serviceContainer->addService($serviceClass, $service);

        return $service;
    }
}
