<?php

use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\web\View;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Словари';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(
            Html::icon('plus') . ' Добавить словарь',
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </p>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => SerialColumn::class],
                'name',
                'info',
                'isbn',
                [
                    'class' => ActionColumn::class,
                    'contentOptions' => [
                        'class' => 'action-column-3',
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
