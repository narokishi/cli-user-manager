<?php
declare(strict_types = 1);

namespace Src;

use Src\DependencyInjection\Container;
use Src\DependencyInjection\InjectableInterface;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class Application
 * @package Src
 */
final class Application extends BaseApplication
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        parent::__construct('Zarządzanie użytkownikami', '1.0.0');
    }

    /**
     * @param Container $container
     * @return $this
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * @return Application
     */
    public function registerCommands(): Application
    {
        $this->addCommands([
            new Command\HelpCommand,
            new Command\ListCommand,
            new Command\User\CreateCommand,
            new Command\User\ListCommand,
            new Command\User\EditCommand,
            new Command\User\GetCommand,
        ]);

        return $this;
    }

    /**
     * @param array $commands
     */
    public function addCommands(array $commands)
    {
        foreach ($commands as $command) {
            if ($command instanceof InjectableInterface) {
                $command->setContainer($this->container);
            }

            $this->add($command);
        }
    }

    /**
     * @return Application
     */
    public function setDefaultDefinition(): Application
    {
        $this->setDefinition(
            new InputDefinition([
                new InputArgument('command', InputArgument::REQUIRED, 'Polecenie do wykonania'),
                new InputOption('--help', '-h', InputOption::VALUE_NONE, 'Wyświetl pomoc'),
                new InputOption('--quiet', '-q', InputOption::VALUE_NONE, 'Nie wyświetlaj wiadomości'),
                new InputOption('--version', '-V', InputOption::VALUE_NONE, 'Wyświetl wersję aplikacji'),
                new InputOption('--ansi', '', InputOption::VALUE_NONE, 'Wymuś wyjście ANSI'),
                new InputOption('--no-ansi', '', InputOption::VALUE_NONE, 'Wyłącz wyjście ANSI'),
            ])
        );

        return $this;
    }
}
