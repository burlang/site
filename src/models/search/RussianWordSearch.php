<?php

declare(strict_types=1);

namespace app\models\search;

use app\models\RussianWord;
use yii\data\ActiveDataProvider;

class RussianWordSearch extends RussianWord
{
    public function rules(): array
    {
        return [
            [['name'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = RussianWord::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
