<?php

declare(strict_types=1);

namespace app\models\queries;

use app\models\News;
use yii\db\ActiveQuery;

/**
 * @extends ActiveQuery<News>
 */
class NewsQuery extends ActiveQuery
{
    public function active(): self
    {
        return $this->andWhere(['active' => 1]);
    }
}
