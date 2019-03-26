#!/usr/bin/env php
<?php
declare(strict_types = 1);

require __DIR__.'/vendor/autoload.php';

$container = new Src\DependencyInjection\Container;
$container->addService(
    Src\PDO::class,
    (new Src\Database)
        ->setEnvironment(new Src\Env)
        ->getConnection()
);

$container->registerService(Src\Domain\User\UserService::class);

$application = (new Src\Application)
    ->setDefaultDefinition()
    ->setContainer($container)
    ->registerCommands();

$application->run(new Src\ArgvInput());