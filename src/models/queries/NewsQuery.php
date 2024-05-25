<?php

declare(strict_types=1);

namespace app\models\queries;

use yii\db\ActiveQuery;

class NewsQuery extends ActiveQuery
{
    public function active(): self
    {
        return $this->andWhere(['active' => 1]);
    }
}
