<?php

namespace app\models\search;

use app\models\BuryatName;
use yii\data\ActiveDataProvider;

class BuryatNameSearch extends BuryatName
{
    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['id', 'male', 'female'], 'integer'],
            [['name', 'description', 'note'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = BuryatName::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'male' => $this->male,
            'female' => $this->female,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
