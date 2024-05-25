<?php

use app\models\search\BuryatNameSearch;
use app\widgets\InputWithBuryatLetters;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var BuryatNameSearch $model
 * @var ActiveForm $form
 */
?>
<div class="buryat-word-search">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Поиск</h4>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
            ]); ?>
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <?= $form->field($model, 'name')->widget(InputWithBuryatLetters::class) ?>
                </div>
                <div class="col-sm-6 col-md-4">
                    <?= $form->field($model, 'description') ?>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-sm-6 col-xs-6">
                            <?= $form->field($model, 'male')->dropDownList(
                                ['0' => 'Нет', '1' => 'Да'],
                                ['prompt' => '']
                            ) ?>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <?= $form->field($model, 'female')->dropDownList(
                                ['0' => 'Нет', '1' => 'Да'],
                                ['prompt' => '']
                            ) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
