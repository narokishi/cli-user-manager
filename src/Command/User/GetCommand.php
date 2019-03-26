<?php
declare(strict_types = 1);

namespace Src\Command\User;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GetCommand
 * @package Src\Command
 */
final class GetCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'user:get';

    /**
     * Configure command's attributes.
     */
    protected function configure()
    {
        $this->setDescription('Wyświetlenie danych użytkownika')
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
Polecenie <info>%command.name%</info> wypisuje dane użytkownika z bazy.

  <info>php %command.full_name% test@test.pl</info>
EOF;
    }
}
