<?php

declare(strict_types=1);

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

defined('YII_DEBUG') || define('YII_DEBUG', (bool)env('APP_DEBUG', ''));
defined('YII_ENV') || define('YII_ENV', env('APP_ENV', 'prod'));

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
