<?php

declare(strict_types=1);

use app\api\Module;
use app\components\AuthManager;
use app\components\DeviceDetector\DeviceDetector;
use app\components\DeviceDetector\DeviceDetectorInterface;
use Detection\MobileDetect;
use yii\caching\CacheInterface;
use yii\caching\FileCache;
use yii\db\Connection;
use yii\grid\ActionColumn;
use yii\log\Dispatcher;
use yii\log\FileTarget;
use yii\rbac\ManagerInterface;
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
        '@npm' => '@vendor/npm-asset',
    ],
    'layoutPath' => '@templates/layouts',
    'viewPath' => '@templates/views',
    'modules' => [
        'api' => [
            'class' => Module::class,
            'modules' => [
                'v1' => app\api\v1\Module::class,
            ],
        ],
    ],
    'components' => [
        'urlManager' => UrlManager::class,
        'db' => Connection::class,
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
                'dsn' => 'mysql:host=' . env('MYSQL_HOST') . ';dbname=' . env('MYSQL_DATABASE'),
                'username' => env('MYSQL_USER'),
                'password' => env('MYSQL_PASSWORD'),
                'charset' => 'utf8',
                'enableSchemaCache' => true,
            ],
            AssetManager::class => [
                'class' => AssetManager::class,
                'forceCopy' => env('APP_ENV', 'prod') === 'dev',
            ],
            ManagerInterface::class => [
                'class' => AuthManager::class,
                'itemFile' => __DIR__ . '/rbac/items.php',
                'ruleFile' => __DIR__ . '/rbac/rules.php',
                'assignmentFile' => __DIR__ . '/rbac/assignments.php',
            ],
            Dispatcher::class => [
                'class' => Dispatcher::class,
                'traceLevel' => (bool)env('APP_DEBUG', '') ? 3 : 0,
                'targets' => [
                    [
                        'class' => FileTarget::class,
                        'levels' => env('APP_ENV', 'prod') === 'prod'
                            ? ['error', 'warning']
                            : ['error', 'warning', 'info'],
                        'maskVars' => [
                            '_SERVER.COOKIE_SECRET',
                            '_SERVER.MYSQL_HOST',
                            '_SERVER.MYSQL_DATABASE',
                            '_SERVER.MYSQL_USER',
                            '_SERVER.MYSQL_PASSWORD',
                            '_SERVER.MYSQL_ROOT_PASSWORD',
                            '_SERVER.BACKUP_NAME',
                            '_SERVER.BACKUP_AWS_ACCESS_KEY_ID',
                            '_SERVER.BACKUP_AWS_SECRET_ACCESS_KEY',
                            '_SERVER.BACKUP_AWS_DEFAULT_REGION',
                            '_SERVER.BACKUP_S3_ENDPOINT',
                            '_SERVER.BACKUP_S3_BUCKET',
                        ],
                    ],
                ],
            ],
            View::class => [
                'class' => View::class,
            ],
            CacheInterface::class => [
                'class' => FileCache::class,
            ],
            DeviceDetectorInterface::class => static fn () => new DeviceDetector(new MobileDetect()),
        ],
        'definitions' => [
            ActionColumn::class => app\components\Grid\ActionColumn::class,
        ],
    ],
    'params' => [],
];
