<?php

use app\components\DeviceDetector\DeviceDetector;
use app\components\DeviceDetector\DeviceDetectorInterface;
use app\services\SearchDataService;
use yii\grid\ActionColumn;

return [
    'definitions' => [
        ActionColumn::class => \app\components\Grid\ActionColumn::class,
    ],
    'singletons' => [
        DeviceDetectorInterface::class => DeviceDetector::class,
        SearchDataService::class => SearchDataService::class,
    ],
];
