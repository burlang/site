<?php

return [
    'components.db' => [
        'class' => \yii\db\Connection::class,
        'dsn' => 'mysql:host=mysql;dbname=burlang',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'enableSchemaCache' => true,
    ],

    'components.mailer' => [
        'useFileTransport' => true,
    ],
];
