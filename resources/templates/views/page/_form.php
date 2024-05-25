<?php

use app\assets\MarkdownEditorAsset;
use app\models\Page;
use app\widgets\InputWithBuryatLetters;
use yii\bootstrap\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var Page $model
 * @var ActiveForm $form
 */

MarkdownEditorAsset::register($this);
?>
<div class="page-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <?= $form->field($model, 'active')->checkbox() ?>
    <?= $form->field($model, 'menu_name')->widget(InputWithBuryatLetters::class, ['options' => ['maxlength' => true]]) ?>
    <?= $form->field($model, 'title')->widget(InputWithBuryatLetters::class, ['options' => ['maxlength' => true]]) ?>
    <?= $form->field($model, 'link')->textInput(
        ['maxlength' => true, 'disabled' => !$model->isNewRecord]
    ) ?>
    <?= $form->field($model, 'description')->widget(InputWithBuryatLetters::class, ['options' => ['maxlength' => true]]) ?>
    <?= $form->field($model, 'content')->textarea(['id' => 'markdown-editor']) ?>
    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord
                ? Html::icon('plus') . ' Создать'
                : Html::icon('floppy-disk') . ' Сохранить',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
