<?php
declare(strict_types = 1);

namespace Src\Domain\Common\ParameterBag;

/**
 * Class FrozenParameterBag
 * @package Src\Domain\Common\ParameterBag
 */
final class FrozenParameterBag extends ParameterBag
{
    /**
     * @var bool
     */
    protected $isFrozen = false;

    /**
     * Ustawia ParameterBag jako zamrożony - od tego czasu nie będzie można zmienić jego zawartości.
     *
     * @return FrozenParameterBag
     */
    public function freeze(): self
    {
        $this->isFrozen = true;

        return $this;
    }

    /**
     * @param array $parameters
     * @throws FrozenParameterLogicException
     */
    public function add(array $parameters)
    {
        if ($this->isFrozen) {
            throw new FrozenParameterLogicException('Impossible to call add() on a frozen ParameterBag.');
        }

        parent::add($parameters);
    }

    /**
     * @throws FrozenParameterLogicException
     */
    public function clear()
    {
        if ($this->isFrozen) {
            throw new FrozenParameterLogicException('Impossible to call clear() on a frozen ParameterBag.');
        }

        parent::clear();
    }

    /**
     * @param string $name
     * @param mixed $value
     * @throws FrozenParameterLogicException
     */
    public function set($name, $value)
    {
        if ($this->isFrozen) {
            throw new FrozenParameterLogicException('Impossible to call set() on a frozen ParameterBag.');
        }

        parent::set($name, $value);
    }

    /**
     * @param string $name
     * @throws FrozenParameterLogicException
     */
    public function remove($name)
    {
        if ($this->isFrozen) {
            throw new FrozenParameterLogicException('Impossible to call remove() on a frozen ParameterBag.');
        }

        parent::remove($name);
    }
}
