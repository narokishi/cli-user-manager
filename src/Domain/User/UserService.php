<?php
declare(strict_types = 1);

namespace Src\Domain\User;

use Src\Domain\Common\ParameterBag\FrozenParameterBag;

/**
 * Class UserService
 *
 * @package Src\Domain\User
 */
final class UserService
{
    /**
     * @var UserQueryRepository
     */
    protected $queryRepository;

    /**
     * @var UserCommandRepository
     */
    protected $cmdRepository;

    /**
     * UserService constructor.
     *
     * @param \PDO $db
     */
    public function __construct(\PDO $db)
    {
        $this->queryRepository = new UserQueryRepository($db);
        $this->cmdRepository = new UserCommandRepository($db);
    }

    /**
     * @return FrozenParameterBag
     */
    public function getUsers(): FrozenParameterBag
    {
        return $this->queryRepository->getUsers();
    }

    /**
     * @param string $email
     * @return DTO\UserDTO|null
     */
    public function getUserByEmail(string $email)
    {
        return $this->queryRepository->getUserByEmail($email);
    }
}
