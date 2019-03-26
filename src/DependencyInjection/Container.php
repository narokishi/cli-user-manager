<?php
declare(strict_types = 1);

namespace Src\DependencyInjection;

use Src\Domain\Common\ParameterBag\ParameterBag;

/**
 * Class Container
 * @package Src\DependencyInjection
 */
final class Container
{
    /**
     * @var ParameterBag
     */
    protected $services;

    /**
     * @var ParameterBag
     */
    protected $registeredServices;

    /**
     * Container constructor.
     */
    public function __construct()
    {
        $this->services = new ParameterBag;
        $this->registeredServices = new ParameterBag;
    }

    /**
     * @param string $serviceClass
     * @param $service
     */
    public function addService(string $serviceClass, $service)
    {
        $this->registeredServices->set($serviceClass, $serviceClass);
        $this->services->set($serviceClass, $service);
    }

    /**
     * Rejestracja nowego serwisu.
     *
     * @param string $serviceClass
     * @param bool $lazyLoad
     */
    public function registerService(string $serviceClass, $lazyLoad = true)
    {
        if (!ServiceBuilder::isValidService($serviceClass)) {
            throw new RegisterServiceException($serviceClass);
        }

        $this->registeredServices->set($serviceClass, $serviceClass);

        if (!$lazyLoad && !$this->services->has($serviceClass)) {
            ServiceBuilder::buildService($serviceClass, $this);
        }
    }

    /**
     * @param string $serviceClass
     * @return ServiceSubscriberInterface
     */
    public function getService(string $serviceClass): ServiceSubscriberInterface
    {
        if ($this->services->has($serviceClass)) {
            return $this->services->get($serviceClass);
        }

        return ServiceBuilder::buildService($serviceClass, $this);
    }

    /**
     * @return array
     */
    public function getBootedServices(): array
    {
        return $this->services->all();
    }
}
