<?php
declare(strict_types = 1);

namespace Src\Domain\User;

use Src\DependencyInjection\ServiceSubscriberInterface;
use Src\Domain\Common\ParameterBag\FrozenParameterBag;
use Src\PDO;

/**
 * Class UserService
 *
 * @package Src\Domain\User
 */
final class UserService implements ServiceSubscriberInterface
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
     * @return array
     */
    public static function getSubscribedServices(): array
    {
        return [
            PDO::class,
        ];
    }
}
