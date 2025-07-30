<?php

use app\components\DeviceDetector\DeviceDetectorInterface;
use app\models\search\BuryatNameSearch;
use app\widgets\FlashMessages;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var View $this
 * @var BuryatNameSearch $searchModel
 * @var ActiveDataProvider $dataProvider
 * @var DeviceDetectorInterface $deviceDetector
 */
$this->title = 'Бурятские имена';
$this->params['breadcrumbs'][] = $this->title;
$isDesktop = $deviceDetector->isDesktop();
?>
<div class="buryat-name-index">
    <h1 class="hidden-xs"><?= Html::encode($this->title); ?></h1>
    <?= FlashMessages::widget(); ?>
    <p>
        <?= Html::a(
            Html::icon('plus') . ' Добавить имя',
            ['create'],
            ['class' => 'btn btn-success']
        ); ?>
    </p>
    <?= $this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(); ?>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'pager' => [
                'maxButtonCount' => $isDesktop ? 10 : 5,
            ],
            'columns' => [
                ['class' => SerialColumn::class],
                'name',
                [
                    'attribute' => 'description',
                    'visible' => $isDesktop,
                ],
                [
                    'attribute' => 'male',
                    'format' => 'boolean',
                    'filter' => ['0' => 'Нет', '1' => 'Да'],
                    'visible' => $isDesktop,
                ],
                [
                    'attribute' => 'female',
                    'format' => 'boolean',
                    'filter' => ['0' => 'Нет', '1' => 'Да'],
                    'visible' => $isDesktop,
                ],
                [
                    'class' => ActionColumn::class,
                    'contentOptions' => [
                        'class' => 'action-column-3',
                    ],
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
