<?php
declare(strict_types = 1);

namespace Src\Domain\Common\ParameterBag;

/**
 * Class ParameterNotFoundException
 * @package Src\Domain\Common\ParameterBag
 */
final class ParameterNotFoundException extends \InvalidArgumentException
{
    /**
     * ParameterNotFoundException constructor.
     *
     * @param string $parameterName
     */
    public function __construct(string $parameterName)
    {
        parent::__construct("You have registered a non-existent parameter \"$parameterName\"", 500);
    }
}
