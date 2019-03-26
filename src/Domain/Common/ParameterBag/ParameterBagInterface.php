<?php
declare(strict_types = 1);

namespace Src\Domain\Common\ParameterBag;

/**
 * Interface ParameterBagInterface
 * @package Src\Domain\Common\ParameterBag
 */
interface ParameterBagInterface
{
    public function clear();

    /**
     * @param array $parameters An array of parameters
     */
    public function add(array $parameters);

    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param string $name
     * @return mixed
     * @throws ParameterNotFoundException
     */
    public function get(string $name);

    /**
     * @param string $name
     */
    public function remove(string $name);

    /**
     * @param string $name
     * @param mixed $value
     */
    public function set(string $name, $value);

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool;
}
