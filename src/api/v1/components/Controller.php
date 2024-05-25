<?php

namespace app\api\v1\components;

use yii\filters\Cors;
use yii\helpers\ArrayHelper;

class Controller extends \yii\rest\Controller
{
    /**
     * {@inheritDoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => Cors::class,
            ],
        ]);
    }
}
