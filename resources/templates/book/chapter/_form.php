<?php

use app\assets\MarkdownEditorAsset;
use app\models\BookChapter;
use app\widgets\InputWithBuryatLetters;
use yii\bootstrap\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var BookChapter $chapter
 * @var ActiveForm $form
 */

MarkdownEditorAsset::register($this);
?>
<div class="book-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($chapter); ?>
    <?= $form->field($chapter, 'title')->widget(
        InputWithBuryatLetters::class,
        ['options' => ['maxlength' => true]]
    ) ?>
    <?= $form->field($chapter, 'content')->textarea(['id' => 'markdown-editor']) ?>
    <div class="form-group">
        <?= Html::submitButton(
            $chapter->isNewRecord
                ? Html::icon('plus') . ' Создать'
                : Html::icon('floppy-disk') . ' Сохранить',
            ['class' => $chapter->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
