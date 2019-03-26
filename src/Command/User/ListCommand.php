<?php
declare(strict_types = 1);

namespace Src\Command\User;

use Src\DependencyInjection\InjectableInterface;
use Src\DependencyInjection\InjectableTrait;
use Src\Domain\User\DTO\UserDTO;
use Src\Domain\User\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ListCommand
 * @package Src\Command
 */
final class ListCommand extends Command implements InjectableInterface
{
    use InjectableTrait;

    /**
     * @var string
     */
    protected static $defaultName = 'user:list';

    /**
     * Configure command's attributes.
     */
    protected function configure()
    {
        $this->setDescription('Wyświetlenie listy użytkowników')
            ->setHelp($this->createHelp());
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var UserService $userService */
        $userService = $this->container->getService(UserService::class);
        $users = $userService->getUsers()->all();
        $userCount = count($users);

        $table = (new Table($output))
            ->setHeaderTitle('Użytkownicy')
            ->setFooterTitle($userCount === 1 ? "$userCount użytkownik" : "$userCount użytkowników")
            ->setHeaders(['Id', 'Email', 'Imię', 'Data utworzenia', 'Data modyfikacji'])
            ->setRows(array_map(function (UserDTO $user) {
                return $user->toArray();
            }, $users));

        $table->render();

        return 0;
    }

    /**
     * @return string
     */
    protected function createHelp(): string
    {
        return <<<EOF
Polecenie <info>%command.name%</info> wypisuje listę użytkowników istniejących w bazie danych.

  <info>php %command.full_name%</info>
EOF;
    }
}
