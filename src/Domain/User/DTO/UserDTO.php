<?php
declare(strict_types = 1);

namespace Src\Domain\User\DTO;

/**
 * Class UserDTO
 * @package Src\Domain\User\DTO
 */
final class UserDTO
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string|null
     */
    protected $updatedAt;

    /**
     * @var string|null
     */
    protected $deletedAt;

    /**
     * UserDTO constructor.
     *
     * @param string $id
     * @param string $email
     * @param string $name
     * @param string $createdAt
     * @param string|null $updatedAt
     * @param string|null $deletedAt
     */
    public function __construct(
        string $id,
        string $email,
        string $name,
        string $createdAt,
        ?string $updatedAt,
        ?string $deletedAt
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
    }

    /**
     * @param array $user
     * @return UserDTO
     */
    public static function createFromArray(array $user)
    {
        return new self(
            $user['id'],
            $user['email'],
            $user['name'],
            $user['created_at'],
            $user['updated_at'],
            $user['deleted_at']
        );
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @return string|null
     */
    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            $this->getId(),
            $this->getEmail(),
            $this->getName(),
            $this->getCreatedAt(),
            $this->getUpdatedAt(),
        ];
    }
}
