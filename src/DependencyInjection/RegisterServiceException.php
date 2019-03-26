<?php
declare(strict_types = 1);

namespace Src\DependencyInjection;

/**
 * Class RegisterServiceException
 * @package Src\DependencyInjection
 */
final class RegisterServiceException extends \InvalidArgumentException
{
    /**
     * RegisterServiceException constructor.
     *
     * @param string $className
     */
    public function __construct(string $className)
    {
        parent::__construct("You have registered a non-existent service \"$className\"", 500);
    }
}
