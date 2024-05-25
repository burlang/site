<?php

declare(strict_types=1);

use yii\console\controllers\MigrateController;
use yii\console\ErrorHandler;
use yii\helpers\ArrayHelper;

return ArrayHelper::merge(
    require __DIR__ . '/common.php',
    [
        'controllerNamespace' => 'app\commands',
        'controllerMap' => [
            'migrate' => [
                'class' => MigrateController::class,
                'migrationPath' => [
                    '@root/database/migrations',
                ],
            ],
        ],
        'components' => [
            'errorHandler' => [
                'class' => ErrorHandler::class,
            ],
        ],
    ],
);
