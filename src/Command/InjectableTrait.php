<?php

namespace Src\Command;

use Src\DependencyInjection\Container;

/**
 * Interface InjectableTrait
 *
 * @package Src\Command
 */
trait InjectableTrait
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @return \PDO
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * @param Container $container
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }
}
