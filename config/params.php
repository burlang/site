<?php

return [
    'components.db' => [
        'class' => \yii\db\Connection::class,
        'dsn' => 'mysql:host=localhost;dbname=burlang',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'enableSchemaCache' => true,
    ],
    'components.cache' => \yii\caching\FileCache::class,
    'components.mailer' => [
        'class' => \yii\swiftmailer\Mailer::class,
        'useFileTransport' => false,
    ],
    'components.request.key' => 'l-2C_lNvBwQDe4_LLC5eaUhQmvV9yQRm',

    'adminEmail' => 'dbulats88@gmail.com',
];
