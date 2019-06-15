<?php
declare(strict_types = 1);

namespace Src\Domain\User;

use Src\Domain\Common\ParameterBag\FrozenParameterBag;
use Src\Domain\User\DTO\UserDTO;

/**
 * Serwis domenowy do zarządzania użytkownikami.
 *
 * Class UserService
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
     * Wyciągnięcie listy wszystkich nieusuniętych użytkowników.
     *
     * @return FrozenParameterBag
     */
    public function getUsers(): FrozenParameterBag
    {
        return $this->queryRepository->getUsers();
    }

    /**
     * Wyciągnięcie danych użytkownika po emailu.
     *
     * @param string $email
     * @return DTO\UserDTO|null
     */
    public function getUserByEmail(string $email)
    {
        return $this->queryRepository->getUserByEmail($email);
    }

    /**
     * Usunięcie użytkownika po emailu.
     *
     * @param string $email
     * @return bool
     * @throws \Exception
     */
    public function deleteUser(string $email)
    {
        $user = $this->getUserByEmail($email);

        if (!$user instanceof UserDTO) {
            throw new \InvalidArgumentException(
                "Użytkownik ($email) nie istnieje."
            );
        }

        if ($user->getDeletedAt()) {
            throw new \LogicException(
                "Użytkownik ($email) jest już usunięty. Nie można go usunąć."
            );
        }

        return $this->cmdRepository->deleteUser($email);
    }

    /**
     * Stworzenie nowego użytkownika.
     *
     * @param string $email
     * @param string $name
     * @return bool
     * @throws \Exception
     */
    public function createUser(string $email, string $name)
    {
        $user = $this->getUserByEmail($email);

        if ($user instanceof UserDTO) {
            throw new \LogicException(
                "Użytkownik ($email) już istnieje."
            );
        }

        return $this->cmdRepository->createUser($email, $name);
    }

    /**
     * Edytowanie danych istniejącego użytkownika.
     *
     * @param string $email
     * @param string $name
     * @return bool
     * @throws \Exception
     */
    public function editUser(string $email, string $name)
    {
        $user = $this->getUserByEmail($email);

        if (!$user instanceof UserDTO) {
            throw new \InvalidArgumentException(
                "Użytkownik ($email) nie istnieje."
            );
        }

        if ($user->getDeletedAt()) {
            throw new \LogicException(
                "Użytkownik ($email) jest usunięty. Nie można go edytować."
            );
        }

        return $this->cmdRepository->editUser($email, $name);
    }
}
