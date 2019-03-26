<?php
declare(strict_types = 1);

namespace Src\Domain\User;

use Src\Domain\Common\AbstractRepository;
use Src\Domain\Common\ParameterBag\FrozenParameterBag;
use Src\Domain\User\DTO\UserDTO;

/**
 * Class UserQueryRepository
 * @package Src\Domain\User
 */
final class UserQueryRepository extends AbstractRepository
{
    /**
     * @return FrozenParameterBag
     */
    public function getUsers(): FrozenParameterBag
    {
        $sqlStatement = <<<SQL
          SELECT
            id,
            email,
            name,
            created_at,
            updated_at
          FROM
            users
SQL;

        $query = $this->db->prepare($sqlStatement);
        $query->execute();

        $parameterBag = new FrozenParameterBag;

        foreach ($query->fetchAll() as $key => $user) {
            $parameterBag->set((string) $key, UserDTO::createFromArray($user));
        }

        return $parameterBag->freeze();
    }
}