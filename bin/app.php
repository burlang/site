<?php

declare(strict_types=1);

use yii\console\Application;

require __DIR__ . '/../bootstrap/app.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/console.php';

$app = new Application($config);
$exitCode = $app->run();
exit($exitCode);
