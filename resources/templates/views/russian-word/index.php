<?php

use app\components\DeviceDetector\DeviceDetectorInterface;
use app\models\RussianWord;
use app\models\search\RussianWordSearch;
use app\widgets\FlashMessages;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var RussianWordSearch $searchModel
 * @var DeviceDetectorInterface $deviceDetector
 */

$this->title = 'Русские слова';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="russian-word-index">
    <h1 class="hidden-xs"><?= Html::encode($this->title) ?></h1>
    <?= FlashMessages::widget() ?>
    <p>
        <?= Html::a(
            Html::icon('plus') . ' Добавить слово',
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </p>
    <?= $this->render('_search', ['model' => $searchModel]) ?>
    <?php Pjax::begin(); ?>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'pager' => [
                'maxButtonCount' => $deviceDetector->isDesktop() ? 10 : 5,
            ],
            'columns' => [
                ['class' => SerialColumn::class],
                'name',
                [
                    'label' => 'Переводы',
                    'value' => function ($model) {
                        /** @var RussianWord $model */
                        return Html::ul(ArrayHelper::getColumn($model->translations, 'name'));
                    },
                    'format' => 'raw',
                    'visible' => $deviceDetector->isDesktop(),
                ],
                [
                    'class' => ActionColumn::class,
                    'template' => '{update} {delete}',
                    'contentOptions' => [
                        'class' => 'action-column-2',
                    ],
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
