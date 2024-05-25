<?php

namespace app\components;

use app\models\Page;
use Yii;
use yii\helpers\Url;

class PageMenu
{
    /**
     * @param string $link
     * @return array|string
     */
    public static function getItem(string $link)
    {
        $model = Page::findOne(['link' => $link]);
        if ($model && $model->active) {
            $url = ['/page/view', 'link' => $link];
            return [
                'label' => $model->menu_name,
                'url' => $url,
                'active' => Yii::$app->request->url === Url::to($url),
            ];
        }
        return '';
    }
}
