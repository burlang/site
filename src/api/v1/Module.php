<?php

declare(strict_types=1);

namespace app\api\v1;

use OpenApi\Attributes as OA;

#[OA\Info(version: '1.0', title: 'Burlang API')]
#[OA\Server(url: 'https://burlang.ru')]
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\api\v1\controllers';
}
