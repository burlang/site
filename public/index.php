<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../bootstrap/app.php';

$config = require __DIR__ . '/../config/web.php';

$app = new \yii\web\Application($config);
$app->run();
