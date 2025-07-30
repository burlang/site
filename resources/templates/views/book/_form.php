<?php

use app\assets\MarkdownEditorAsset;
use app\models\Book;
use app\widgets\InputWithBuryatLetters;
use app\widgets\TextareaWithBuryatLetters;
use yii\bootstrap\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var Book $model
 * @var ActiveForm $form
 */
MarkdownEditorAsset::register($this);
?>
<div class="book-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <?= $form->field($model, 'active')->checkbox(); ?>
    <?= $form->field($model, 'title')->widget(InputWithBuryatLetters::class, ['options' => ['maxlength' => true]]); ?>
    <?= $form->field($model, 'description')->widget(TextareaWithBuryatLetters::class, ['options' => ['rows' => 5]]); ?>
    <?= $form->field($model, 'content')->textarea(['class' => 'markdown-editor']); ?>
    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord
                ? Html::icon('plus') . ' Создать'
                : Html::icon('floppy-disk') . ' Сохранить',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
