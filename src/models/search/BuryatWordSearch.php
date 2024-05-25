<?php

namespace app\models\search;

use app\models\BuryatWord;
use yii\data\ActiveDataProvider;

class BuryatWordSearch extends BuryatWord
{
    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = BuryatWord::find();

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
