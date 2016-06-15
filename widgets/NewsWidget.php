<?php

namespace app\widgets;

use Yii;
use app\models\News;
use yii\base\Widget;

class NewsWidget extends Widget
{
    public function run()
    {
        $query = News::find();
        if (Yii::$app->user->isGuest) {
            $query->where(['active' => 1]);
        }
        $model = $query->orderBy('created_at DESC')->limit(3)->all();

        return $this->render('news', [
            'model' => $model
        ]);
    }
}