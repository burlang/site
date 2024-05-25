<?php

declare(strict_types=1);

namespace app\widgets;

use app\models\News;
use yii\base\Widget;

class LastNews extends Widget
{
    public int $limit = 3;

    public function run(): string
    {
        return $this->render('@templates/widgets/last-news', [
            'lastNews' => News::find()
                ->active()
                ->orderBy('created_at DESC')
                ->limit($this->limit)
                ->all(),
        ]);
    }
}
