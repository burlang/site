<?php

$params = array_merge(
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

$config = [
    'id' => 'burlang',
    'name' => 'Burlang',
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',
    'timeZone' => 'Asia/Irkutsk',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'container' => require __DIR__ . '/container.php',
    'components' => [
        'db' => $params['components.db'],
        'cache' => $params['components.cache'],
        'mailer' => $params['components.mailer'],
        'user' => [
            'class' => \yii\web\User::class,
            'identityClass' => \app\models\User::class,
            'loginUrl' => ['auth/login'],
            'enableAutoLogin' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require __DIR__ . '/routes.php',
        ],
        'authManager' => [
            'class' => \yii\rbac\PhpManager::class,
            'itemFile' => __DIR__ . '/rbac/items.php',
            'ruleFile' => __DIR__ . '/rbac/rules.php',
            'assignmentFile' => __DIR__ . '/rbac/assignments.php',
        ],
        'assetManager' => [
            'class' => \yii\web\AssetManager::class,
            'appendTimestamp' => true,
        ],
        'request' => [
            'cookieValidationKey' => $params['components.request.key'],
            'parsers' => [
                'application/json' => \yii\web\JsonParser::class,
            ],
        ],
        'response' => [
            'class' => \yii\web\Response::class,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'modules' => [
        'api' => [
            'class' => \app\modules\api\Module::class,
            'modules' => [
                'v1' => \app\modules\api\v1\Module::class,
            ],
        ],
    ],
    'params' => $params,
];

return $config;
