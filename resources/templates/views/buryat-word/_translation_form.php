<?php

use app\components\DeviceDetector\DeviceDetectorInterface;
use app\models\BuryatTranslation;
use app\models\BuryatWord;
use app\widgets\InputWithBuryatLetters;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/**
 * @var BuryatTranslation $translationForm
 * @var array<int, string> $dictionaries
 * @var BuryatWord $model
 * @var DeviceDetectorInterface $deviceDetector
 */
?>
<hr>
<h4>Переводы</h4>
<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => (new ActiveDataProvider([
            'query' => $model->getTranslations(),
            'pagination' => false,
        ])),
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'dict_id',
                'value' => 'dictionary.name',
                'visible' => $deviceDetector->isDesktop(),
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => static function ($url, $model) {
                        return Html::a(
                            Html::icon('trash'),
                            ['delete-translation', 'id' => $model->id],
                            [
                                'title' => 'Удалить перевод',
                                'class' => 'btn btn-sm btn-danger',
                                'data' => [
                                    'confirm' => 'Вы уверены, что хотите удалить?',
                                    'method' => 'post',
                                ],
                            ]
                        );
                    },
                ],
                'contentOptions' => [
                    'class' => 'action-column-1',
                ],
            ],
        ],
    ]); ?>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">Добавить перевод</h4>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($translationForm, 'name')
                    ->widget(InputWithBuryatLetters::class); ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($translationForm, 'dict_id')
                    ->dropDownList($dictionaries, ['prompt' => '-']); ?>
            </div>
        </div>
        <?= $form->field($translationForm, 'burword_id')
            ->hiddenInput(['value' => $model->id])
            ->label(false); ?>
        <?= Html::submitButton(
            Html::icon('plus') . ' Добавить',
            ['class' => 'btn btn-success']
        ); ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
