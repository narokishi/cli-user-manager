<?php
declare(strict_types = 1);

namespace Src\Command\User;

use Src\DependencyInjection\InjectableInterface;
use Src\DependencyInjection\InjectableTrait;
use Src\Domain\User\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateCommand
 * @package Src\Command
 */
final class CreateCommand extends Command implements InjectableInterface
{
    use InjectableTrait;

    /**
     * @var string
     */
    protected static $defaultName = 'user:create';

    /**
     * Configure command's attributes.
     */
    protected function configure()
    {
        $this->setDescription('Dodawanie użytkownika')
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
            $userService->createUser(
                $input->getArgument('email'),
                $input->getOption('name')
            );
        } catch (\Exception $e) {
            $output->writeln("<error>{$e->getMessage()}</error>");

            return 500;
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
            new InputOption('name', null, InputOption::VALUE_REQUIRED, 'Imię użytkownika'),
        ]);
    }

    /**
     * @return string
     */
    protected function createHelp(): string
    {
        return <<<EOF
Polecenie <info>%command.name%</info> tworzy nowego użytkownika w bazie danych.

  <info>php %command.full_name% test@test.pl --name=Test</info>
EOF;
    }
}
