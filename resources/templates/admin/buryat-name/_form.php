<?php

use app\models\BuryatName;
use app\widgets\InputWithBuryatLetters\InputWithBuryatLetters;
use app\widgets\TextareaWithBuryatLetters;
use yii\bootstrap\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var BuryatName $model
 * @var ActiveForm $form
 */
?>
<div class="buryat-name-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->widget(InputWithBuryatLetters::class, ['options' => ['maxlength' => true]]) ?>
    <?= $form->field($model, 'description')->widget(InputWithBuryatLetters::class, ['options' => ['maxlength' => true]]) ?>
    <?= $form->field($model, 'note')->widget(TextareaWithBuryatLetters::class, ['options' => ['rows' => 5]]) ?>
    <?= $form->field($model, 'male')->checkbox() ?>
    <?= $form->field($model, 'female')->checkbox() ?>
    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord
                ? Html::icon('plus') . ' Добавить'
                : Html::icon('floppy-disk') . ' Сохранить',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
