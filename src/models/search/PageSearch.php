<?php

declare(strict_types=1);

namespace app\models\search;

use app\models\Page;
use yii\data\ActiveDataProvider;

class PageSearch extends Page
{
    public function rules(): array
    {
        return [
            [['id', 'active', 'static'], 'integer'],
            [['menu_name', 'title', 'link', 'description', 'content'], 'safe'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Page::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'active' => $this->active,
            'static' => $this->static,
        ]);

        $query->andFilterWhere(['like', 'menu_name', $this->menu_name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
