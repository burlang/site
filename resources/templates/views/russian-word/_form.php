<?php

use app\models\RussianWord;
use yii\bootstrap\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var RussianWord $model
 * @var array $dictionaries
 */
?>
<div class="russian-word-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'dict_id')->dropDownList($dictionaries, ['prompt' => '-']) ?>
    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord
                ? Html::icon('plus') . ' Создать'
                : Html::icon('floppy-disk') . ' Сохранить',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
        <?php if (!$model->isNewRecord): ?>
            <?= Html::a(Html::icon('trash') . ' Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
