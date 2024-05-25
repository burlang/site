<?php

declare(strict_types=1);

namespace app\services;

use app\models\SearchData;
use yii\db\Exception;

class SearchDataService
{
    /**
     * @throws Exception
     */
    public function add(string $word, int $type): void
    {
        $model = new SearchData();
        $model->name = \strlen($word) > 255
            ? mb_substr($word, 0, 254)
            : $word;
        $model->type = $type;
        if (!$model->save()) {
            throw new Exception('Не удалось добавить данные');
        }
    }
}
