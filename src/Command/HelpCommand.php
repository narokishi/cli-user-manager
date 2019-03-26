<?php
declare(strict_types = 1);

namespace Src\Command;

use Symfony\Component\Console\Command\HelpCommand as BaseHelpCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class HelpCommand
 * @package Src\Command
 */
final class HelpCommand extends BaseHelpCommand
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
        $this->setName('help')
            ->setDefinition($this->createDefinition())
            ->setHelp($this->createHelp())
            ->setDescription('Wyświetlenie pomocy');
    }

    /**
     * @return InputDefinition
     */
    protected function createDefinition(): InputDefinition
    {
        return new InputDefinition([
            new InputArgument('command_name', InputArgument::OPTIONAL, 'Nazwa polecenia', 'help'),
            new InputOption('format', null, InputOption::VALUE_REQUIRED, 'Format wyświetlania (txt, xml, json, or md)', 'txt'),
            new InputOption('raw', null, InputOption::VALUE_NONE, 'Wyświetlenie surowego tekstu'),
        ]);
    }

    /**
     * @return string
     */
    protected function createHelp(): string
    {
        return <<<EOF
Polecenie <info>%command.name%</info> wyświetla pomoc dla danego polecenia, na przykład:

  <info>php %command.full_name% list</info>

Możesz również zmienić sposób wyświetlenia używając flagi <comment>--format</comment>:

  <info>php %command.full_name% --format=xml list</info>

Aby wyświetlić listę dostępnych poleceń użyj polecenia <info>list</info>.
EOF;
    }
}
