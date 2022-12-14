<?php

use app\components\DeviceDetect\DeviceDetect;
use app\components\DeviceDetect\DeviceDetectInterface;
use app\services\SearchDataService;
use Detection\MobileDetect;
use yii\grid\ActionColumn;

return [
    'definitions' => [
        ActionColumn::class => \app\components\Grid\ActionColumn::class,
    ],
    'singletons' => [
        DeviceDetectInterface::class => function () {
            $mobileDetect = new MobileDetect();
            return new DeviceDetect(
                $mobileDetect->isMobile(),
                $mobileDetect->isTablet()
            );
        },
        SearchDataService::class => SearchDataService::class,
    ],
];
