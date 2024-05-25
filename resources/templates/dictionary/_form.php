<?php

use app\models\Dictionary;
use yii\bootstrap\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var Dictionary $model
 * @var ActiveForm $form
 */
?>
<div class="dictionaries-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'info')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>
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
