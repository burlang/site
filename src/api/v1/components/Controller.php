<?php

declare(strict_types=1);

namespace app\api\v1\components;

use yii\filters\Cors;
use yii\helpers\ArrayHelper;

class Controller extends \yii\rest\Controller
{
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => Cors::class,
            ],
            'resourceNormalizer' => [
                'class' => ResourceNormalizer::class,
            ],
        ]);
    }
}
