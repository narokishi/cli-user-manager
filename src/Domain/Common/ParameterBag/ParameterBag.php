<?php
declare(strict_types = 1);

namespace Src\Domain\Common\ParameterBag;

/**
 * Class ParameterBag
 * @package Src\Domain\Common\ParameterBag
 */
class ParameterBag implements ParameterBagInterface
{
    /**
     * @var array
     */
    protected $parameters = [];

    public function clear()
    {
        $this->parameters = [];
    }

    /**
     * @param array $parameters
     */
    public function add(array $parameters)
    {
        foreach ($parameters as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->parameters;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get(string $name)
    {
        if (!$this->has($name)) {
            throw new ParameterNotFoundException(
                "You have requested a non-existent parameter \"$name\""
            );
        }

        return $this->parameters[$name];
    }

    /**
     * @param string $name
     */
    public function remove(string $name)
    {
        unset($this->parameters[$name]);
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function set(string $name, $value)
    {
        $this->parameters[$name] = $value;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return array_key_exists($name, $this->parameters);
    }
}
