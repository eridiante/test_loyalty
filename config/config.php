<?php

return [
    'mysql' => [
        'host' => $_ENV['DB_HOST'],
        'database' => $_ENV['DB_DATABASE'],
        'username' => $_ENV['DB_USERNAME'],
        'password' => $_ENV['DB_PASSWORD'],
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'driver' => 'mysql',
    ],
    'sqlite_testing' => [
        'driver'   => 'sqlite',
        'database' => __DIR__ . '/../tests/db/database.sqlite',
        'prefix'   => '',
    ],
];
