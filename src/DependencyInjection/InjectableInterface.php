<?php

namespace Src\DependencyInjection;

/**
 * Interface InjectableInterface
 * @package Src\Command
 */
interface InjectableInterface
{
    /**
     * @return Container
     */
    public function getContainer(): Container;

    /**
     * @param Container $container
     * @return InjectableInterface
     */
    public function setContainer(Container $container);
}
