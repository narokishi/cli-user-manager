<?php

namespace Test;

/**
 * Class Stopwatch
 * @package Test
 */
final class Stopwatch
{
    /**
     * @var \DateTime|null
     */
    protected $startsAt;

    /**
     * @var \DateTime|null
     */
    protected $endsAt;

    /**
     * @return Stopwatch
     */
    public function start(): Stopwatch
    {
        $this->startsAt = new \DateTime;

        return $this;
    }

    /**
     * @throws \LogicException
     * @return Stopwatch
     */
    public function stop(): Stopwatch
    {
        if (!$this->startsAt instanceof \DateTime) {
            throw new \LogicException(
                "You can't stop a non-started stopwatch"
            );
        }

        $this->endsAt = new \DateTime;

        return $this;
    }

    /**
     * @return float
     */
    public function getResult()
    {
        if (!$this->endsAt instanceof \DateTime) {
            throw new \LogicException(
                "You can't get result of non-recorded lap"
            );
        }

        return $this->startsAt->diff($this->endsAt, true)->f;
    }
}
