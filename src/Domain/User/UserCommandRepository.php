<?php
declare(strict_types = 1);

namespace Src\Domain\User;

use Src\Domain\Common\AbstractRepository;

/**
 * Class UserCommandRepository
 * @package Src\Domain\User
 */
final class UserCommandRepository extends AbstractRepository
{
    /**
     * @param string $email
     * @return bool
     */
    public function deleteUser(string $email)
    {
        $sqlStatement = <<<SQL
          UPDATE
            users
          SET
            deleted_at = NOW()
          WHERE
            email = :email
SQL;

        $query = $this->db->prepare($sqlStatement);

        return !!$query->execute([
            'email' => $email,
        ]);
    }

    /**
     * @param string $email
     * @param string $name
     * @return bool
     */
    public function createUser(string $email, string $name)
    {
        $sqlStatement = <<<SQL
          INSERT INTO
            users (
              name,
              email
            ) 
          VALUES
            (
               :name,
               :email
            )
SQL;

        $query = $this->db->prepare($sqlStatement);

        return !!$query->execute([
            'name' => $name,
            'email' => $email,
        ]);
    }

    /**
     * @param string $email
     * @param string $name
     * @return bool
     */
    public function editUser(string $email, string $name)
    {
        $sqlStatement = <<<SQL
          UPDATE
            users
          SET
            name = :name,
            updated_at = NOW()
          WHERE
            email = :email
SQL;

        $query = $this->db->prepare($sqlStatement);

        return !!$query->execute([
            'email' => $email,
            'name' => $name,
        ]);
    }
}
