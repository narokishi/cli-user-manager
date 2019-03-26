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
        $this->services->set($serviceClass, $service);
    }

    /**
     * Rejestracja nowego serwisu.
     *
     * @param string $serviceClass
     * @param callable $definition
     * @param bool $lazyLoad
     */
    public function registerService(string $serviceClass, callable $definition, $lazyLoad = true)
    {
        $this->registeredServices->set($serviceClass, $definition);

        if (!$lazyLoad && !$this->services->has($serviceClass)) {
            ServiceBuilder::buildService($serviceClass, $this);
        }
    }

    /**
     * @param string $serviceClass
     * @return mixed
     */
    public function getService(string $serviceClass)
    {
        if ($this->services->has($serviceClass)) {
            return $this->services->get($serviceClass);
        }

        return ServiceBuilder::buildService($serviceClass, $this);
    }

    /**
     * @debug Metoda do sprawdzenia załadowanych serwisów w ramach requestu.
     * @return array
     */
    public function getBootedServices(): array
    {
        return $this->services->all();
    }

    /**
     * @param string $serviceClass
     * @return mixed
     */
    public function getRegisteredService(string $serviceClass)
    {
        if (!$this->registeredServices->has($serviceClass)) {
            throw new RegisterServiceException($serviceClass);
        }

        return $this->registeredServices->get($serviceClass);
    }
}
