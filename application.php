<?php
declare(strict_types = 1);

/**
 * Zarządzanie użytkownikami.
 *
 * @author Tomasz Motyl <tomasz.motyl806@gmail.com>
 * @version 1.0.0
 * @license MIT
 *   Copyright (c) 2019 Tomasz Motyl
 *   Permission is hereby granted, free of charge, to any person obtaining a copy
 *   of this software and associated documentation files (the "Software"), to deal
 *   in the Software without restriction, including without limitation the rights
 *   to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *   copies of the Software
 */

use Src\DependencyInjection\Container;

require __DIR__.'/vendor/autoload.php';

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
