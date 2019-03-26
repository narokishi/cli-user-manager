<?php
declare(strict_types = 1);

namespace Src\Domain\Common;

/**
 * Class AbstractRepository
 * @package Src\Domain\Common
 */
abstract class AbstractRepository
{
    /**
     * @var \PDO
     */
    protected $db;

    /**
     * AbstractRepository constructor.
     *
     * @param \PDO $db
     */
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }
}
