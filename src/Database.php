<?php
declare(strict_types = 1);

namespace Src;

/**
 * Class Database
 * @package Src
 */
final class Database
{
    /**
     * @var Env
     */
    protected $env;

    /**
     * @param Env $env
     * @return $this
     */
    public function setEnvironment(Env $env): Database
    {
        $this->env = $env;

        return $this;
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return Connection::get(
            $this->env->get('dbHost'),
            $this->env->get('dbPort'),
            $this->env->get('dbDatabase'),
            $this->env->get('dbUser'),
            $this->env->get('dbPassword')
        );
    }
}
