<?php
declare(strict_types = 1);

namespace Src\DependencyInjection;

/**
 * Class ServiceNotFoundException
 * @package Src\DependencyInjection
 */
final class ServiceNotFoundException extends \InvalidArgumentException
{
    /**
     * ServiceNotFoundException constructor.
     *
     * @param string $className
     */
    public function __construct(string $className)
    {
        parent::__construct("You have registered a non-existent service \"$className\"", 500);
    }
}