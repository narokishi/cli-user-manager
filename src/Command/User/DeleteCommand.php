<?php
declare(strict_types = 1);

namespace Src\Command\User;

use Src\DependencyInjection\InjectableInterface;
use Src\DependencyInjection\InjectableTrait;
use Src\Domain\User\DTO\UserDTO;
use Src\Domain\User\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DeleteCommand
 * @package Src\Command\User
 */
final class DeleteCommand extends Command implements InjectableInterface
{
    use InjectableTrait;

    /**
     * @var string
     */
    protected static $defaultName = 'user:delete';

    /**
     * Configure command's attributes.
     */
    protected function configure()
    {
        $this->setDescription('Usuwanie użytkownika')
            ->setDefinition($this->createDefinition())
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

        try {
            $userService->deleteUser($input->getArgument('email'));
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());
        }

        return 0;
    }

    /**
     * @return InputDefinition
     */
    protected function createDefinition(): InputDefinition
    {
        return new InputDefinition([
            new InputArgument('email', InputArgument::REQUIRED, 'E-mail użytkownika'),
        ]);
    }

    /**
     * @return string
     */
    protected function createHelp(): string
    {
        return <<<EOF
Polecenie <info>%command.name%</info> usuwa użytkownika z bazy danych.

  <info>php %command.full_name% test@test.pl</info>
EOF;
    }
}
