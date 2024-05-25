<?php

declare(strict_types=1);

use yii\web\Application;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../bootstrap/app.php';

$config = require __DIR__ . '/../config/web.php';

$app = new Application($config);
$app->run();
