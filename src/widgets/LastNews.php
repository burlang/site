<?php

namespace app\widgets;

use app\models\News;
use yii\base\Widget;

class LastNews extends Widget
{
    public int $limit = 3;

    /**
     * {@inheritDoc}
     */
    public function run(): string
    {
        return $this->render('last-news', [
            'lastNews' => News::find()
                ->active()
                ->orderBy('created_at DESC')
                ->limit($this->limit)
                ->all(),
        ]);
    }
}
