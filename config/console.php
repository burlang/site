<?php

$params = require __DIR__ . '/params.php';

$config = [
    'id' => 'basic-console',
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layoutPath' => '@app/resources/templates/layouts',
    'viewPath' => '@app/resources/templates',
    'controllerNamespace' => 'app\commands',
    'components' => [
        'db' => $params['components.db'],
        'cache' => $params['components.cache'],
        'log' => [
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];

return $config;
