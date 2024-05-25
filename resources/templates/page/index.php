<?php

use app\models\search\PageSearch;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\web\View;

/**
 * @var View $this
 * @var PageSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(
            Html::icon('plus') . ' Создать страницу',
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </p>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => SerialColumn::class],
                'menu_name',
                'title',
                'link',
                'description',
                [
                    'attribute' => 'active',
                    'filter' => ['0' => 'Нет', '1' => 'Да'],
                    'format' => 'boolean',
                ],
                [
                    'attribute' => 'static',
                    'filter' => ['0' => 'Нет', '1' => 'Да'],
                    'format' => 'boolean',
                ],
                [
                    'class' => ActionColumn::class,
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(
                                Html::icon('eye-open'),
                                ['view', 'link' => $model->link],
                                [
                                    'title' => Yii::t('yii', 'View'),
                                    'class' => 'btn btn-sm btn-default',
                                    'aria-label' => Yii::t('yii', 'View'),
                                    'data-pjax' => '0',
                                ]
                            );
                        },
                        'delete' => function ($url, $model) {
                            if (!$model->static) {
                                return Html::a(
                                    Html::icon('trash'),
                                    $url,
                                    [
                                        'title' => Yii::t('yii', 'Delete'),
                                        'class' => 'btn btn-sm btn-danger',
                                        'aria-label' => Yii::t('yii', 'Delete'),
                                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                        'data-method' => 'post',
                                        'data-pjax' => '0',
                                    ]
                                );
                            }
                        },
                    ],
                    'contentOptions' => [
                        'class' => 'action-column-3',
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
