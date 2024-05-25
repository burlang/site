<?php

declare(strict_types=1);

use yii\console\ErrorHandler;
use yii\helpers\ArrayHelper;

return ArrayHelper::merge(
    require __DIR__ . '/common.php',
    [
        'controllerNamespace' => 'app\commands',
        'components' => [
            'errorHandler' => [
                'class' => ErrorHandler::class,
            ],
        ],
    ],
);
