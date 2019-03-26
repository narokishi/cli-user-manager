<?php
declare(strict_types = 1);

namespace Src\Command;

use Symfony\Component\Console\Command\ListCommand as BaseListCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class HelpCommand
 * @package Src\Command
 */
final class ListCommand extends BaseListCommand
{
    /**
     * @return InputDefinition
     */
    public function getNativeDefinition()
    {
        return $this->createDefinition();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('list')
            ->setDefinition($this->createDefinition())
            ->setHelp($this->createHelp())
            ->setDescription('Wyświetlenie listy dostępnych poleceń');
    }

    /**
     * @return InputDefinition
     */
    protected function createDefinition(): InputDefinition
    {
        return new InputDefinition([
            new InputArgument('namespace', InputArgument::OPTIONAL, 'Przestrzeń nazw'),
            new InputOption('raw', null, InputOption::VALUE_NONE, 'Wyświetlenie surowego tekstu'),
            new InputOption('format', null, InputOption::VALUE_REQUIRED, 'Format wyswietlania (txt, xml, json, or md)', 'txt'),
        ]);
    }

    /**
     * @return string
     */
    protected function createHelp(): string
    {
        return <<<EOF
Polecenie <info>%command.name%</info> wypisuje wszystkie polecenia:

  <info>php %command.full_name%</info>

Możesz również wyświetlić polecenia z wybranej przestrzeni nazw:

  <info>php %command.full_name% test</info>

Możesz również zmienić sposób wyświetlenia używając flagi <comment>--format</comment>:

  <info>php %command.full_name% --format=xml</info>

Również jest możliwe wyświetlenie surowego tekstu listy poleceń:

  <info>php %command.full_name% --raw</info>
EOF;
    }
}
