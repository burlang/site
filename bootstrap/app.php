<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

defined('YII_DEBUG') || define('YII_DEBUG', (bool)env('APP_DEBUG', ''));
defined('YII_ENV') || define('YII_ENV', env('APP_ENV', 'prod'));
