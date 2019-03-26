#!/usr/bin/env php
<?php
declare(strict_types = 1);

use Src\DependencyInjection\Container;

require __DIR__.'/vendor/autoload.php';

$stopwatch = new \Test\Stopwatch;
$stopwatch->start();

$container = new Container;
$container->registerService(\PDO::class, function () {
    return (new Src\Database)
        ->setEnvironment(new Src\Env)
        ->getConnection();
});

$container->registerService(Src\Domain\User\UserService::class, function (Container $container) {
    return new Src\Domain\User\UserService(
        $container->getService(\PDO::class)
    );
});

$application = (new Src\Application)
    ->setDefaultDefinition()
    ->setContainer($container)
    ->registerCommands();

$application->setAutoExit(false);
$application->run(new Src\ArgvInput());

$stopwatch->stop();
echo "Czas wykonania: {$stopwatch->getResult()} sekund";
