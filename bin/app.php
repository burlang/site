<?php

declare(strict_types=1);

use yii\console\Application;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../bootstrap/app.php';

$config = require __DIR__ . '/../config/console.php';

$app = new Application($config);
$exitCode = $app->run();
exit($exitCode);
