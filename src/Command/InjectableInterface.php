<?php

namespace Src\Command;

use Src\DependencyInjection\Container;

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
