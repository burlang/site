<?php
defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/vendor/yiisoft/yii2/Yii.php';

$config = \yii\helpers\ArrayHelper::merge(
    require dirname(__DIR__) . '/config/console.php',
    require dirname(__DIR__) . '/config/console-local.php'
);

$application = new \yii\console\Application($config);
$exitCode = $application->run();
exit($exitCode);
