<?php
declare(strict_types = 1);

namespace Src;

/**
 * Class Connection
 * @package Src
 */
final class Connection
{
    /**
     * @const string
     */
    protected const PGSQL_PATTERN = 'pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s';

    /**
     * @param string $host
     * @param string $port
     * @param string $database
     * @param string $user
     * @param string $password
     * @return \PDO
     */
    public static function get(
        string $host,
        string $port,
        string $database,
        string $user,
        string $password
    ): PDO {
        return new PDO(
            sprintf(
                self::PGSQL_PATTERN,
                $host,
                $port,
                $database,
                $user,
                $password
            )
        );
    }
}
