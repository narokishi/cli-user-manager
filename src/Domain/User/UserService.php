<?php
declare(strict_types = 1);

namespace Src\Domain\User;

use Src\Domain\Common\ParameterBag\FrozenParameterBag;
use Src\Domain\User\DTO\UserDTO;

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

    /**
     * @param string $email
     * @return bool
     * @throws \Exception
     */
    public function deleteUser(string $email)
    {
        $user = $this->getUserByEmail($email);

        if (!$user instanceof UserDTO) {
            throw new \Exception(
                "Użytkownik ($email) nie istnieje."
            );
        }

        if ($user->getDeletedAt()) {
            throw new \Exception(
                "Użytkownik ($email) jest już usunięty."
            );
        }

        return $this->cmdRepository->deleteUser($email);
    }

    /**
     * @param string $email
     * @param string $name
     * @return bool
     * @throws \Exception
     */
    public function createUser(string $email, string $name)
    {
        $user = $this->getUserByEmail($email);

        if ($user instanceof UserDTO) {
            throw new \Exception(
                "Użytkownik ($email) już istnieje."
            );
        }

        return $this->cmdRepository->createUser($email, $name);
    }

    /**
     * @param string $email
     * @param string $name
     * @return bool
     * @throws \Exception
     */
    public function editUser(string $email, string $name)
    {
        $user = $this->getUserByEmail($email);

        if (!$user instanceof UserDTO) {
            throw new \Exception(
                "Użytkownik ($email) nie istnieje."
            );
        }

        return $this->cmdRepository->editUser($email, $name);
    }
}
