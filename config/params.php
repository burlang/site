<?php

return [
    'components.db' => [
        'class' => \yii\db\Connection::class,
        'dsn' => 'mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_DATABASE'),
        'username' => env('DB_USERNAME'),
        'password' => env('DB_PASSWORD'),
        'charset' => 'utf8',
        'enableSchemaCache' => true,
    ],
    'components.cache' => \yii\caching\FileCache::class,
    'components.mailer' => [
        'class' => \yii\symfonymailer\Mailer::class,
        'useFileTransport' => false,
    ],

    'adminEmail' => 'info@burlang.org',
];
