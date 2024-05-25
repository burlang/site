<?php

declare(strict_types=1);

use app\components\AuthManager;
use app\components\DeviceDetector\DeviceDetector;
use app\components\DeviceDetector\DeviceDetectorInterface;
use app\services\SearchDataService;
use yii\caching\CacheInterface;
use yii\caching\FileCache;
use yii\db\Connection;
use yii\grid\ActionColumn;
use yii\log\Dispatcher;
use yii\log\FileTarget;
use yii\rbac\ManagerInterface;
use yii\symfonymailer\Mailer;
use yii\web\AssetManager;
use yii\web\UrlManager;
use yii\web\View;

return [
    'id' => 'burlang',
    'name' => 'Burlang',
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',
    'timeZone' => 'Asia/Irkutsk',
    'basePath' => dirname(__DIR__) . '/src',
    'vendorPath' => dirname(__DIR__) . '/vendor',
    'runtimePath' => dirname(__DIR__) . '/var',
    'bootstrap' => ['log'],
    'aliases' => [
        '@root' => dirname(__DIR__),
        '@templates' => '@root/resources/templates',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'layoutPath' => '@templates/views/layouts',
    'viewPath' => '@templates/views',
    'modules' => [
        'api' => [
            'class' => \app\api\Module::class,
            'modules' => [
                'v1' => \app\api\v1\Module::class,
                'viewPath' => '@templates/api/v1',
            ],
        ],
    ],
    'components' => [
        'urlManager' => UrlManager::class,
        'db' => Connection::class,
        'mailer' => Mailer::class,
        'assetManager' => AssetManager::class,
        'authManager' => ManagerInterface::class,
        'log' => Dispatcher::class,
        'view' => View::class,
        'cache' => CacheInterface::class,
    ],
    'container' => [
        'singletons' => [
            UrlManager::class => [
                'class' => UrlManager::class,
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => require __DIR__ . '/routes.php',
            ],
            Connection::class => [
                'class' => Connection::class,
                'dsn' => 'mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'charset' => 'utf8',
                'enableSchemaCache' => true,
            ],
            Mailer::class => [
                'class' => Mailer::class,
                'viewPath' => '@app/resources/mail',
                'useFileTransport' => false,
            ],
            AssetManager::class => [
                'class' => AssetManager::class,
                'appendTimestamp' => true,
            ],
            ManagerInterface::class => [
                'class' => AuthManager::class,
                'itemFile' => __DIR__ . '/rbac/items.php',
                'ruleFile' => __DIR__ . '/rbac/rules.php',
                'assignmentFile' => __DIR__ . '/rbac/assignments.php',
            ],
            Dispatcher::class => [
                'class' => Dispatcher::class,
                'traceLevel' => YII_DEBUG ? 3 : 0,
                'targets' => [
                    [
                        'class' => FileTarget::class,
                        'levels' => ['error', 'warning'],
                    ],
                ],
            ],
            View::class => [
                'class' => View::class,
            ],
            CacheInterface::class => [
                'class' => FileCache::class,
            ],
            DeviceDetectorInterface::class => DeviceDetector::class,
            SearchDataService::class => SearchDataService::class,
        ],
        'definitions' => [
            ActionColumn::class => \app\components\Grid\ActionColumn::class,
        ],
    ],
    'params' => [],
];
