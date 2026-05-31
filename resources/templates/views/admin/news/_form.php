<?php

use app\assets\EasyMdeAsset;
use app\models\News;
use app\widgets\InputWithBuryatLetters;
use app\widgets\TextareaWithBuryatLetters;
use yii\bootstrap\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var News $model
 * @var ActiveForm $form
 */
EasyMdeAsset::register($this);
$this->registerJs(
    <<<'JS'
        const easyMDE = new EasyMDE({
            element: document.querySelector('.markdown-editor'),
            spellChecker: false,
            toolbar: [
                'bold', 'italic', 'heading', '|',
                'quote', 'unordered-list', 'ordered-list', '|',
                'link', 'image', 'preview', '|',
                {
                    name: 'buryat-u',
                    action: function(editor) {
                        const cm = editor.codemirror;
                        const selection = cm.getSelection();
                        cm.replaceSelection('Ү');
                    },
                    text: 'Ү',
                    title: 'Insert Ү'
                },
                {
                    name: 'buryat-u-small',
                    action: function(editor) {
                        const cm = editor.codemirror;
                        const selection = cm.getSelection();
                        cm.replaceSelection('ү');
                    },
                    text: 'ү',
                    title: 'Insert ү'
                },
                {
                    name: 'buryat-h',
                    action: function(editor) {
                        const cm = editor.codemirror;
                        const selection = cm.getSelection();
                        cm.replaceSelection('Һ');
                    },
                    text: 'Һ',
                    title: 'Insert Һ'
                },
                {
                    name: 'buryat-h-small',
                    action: function(editor) {
                        const cm = editor.codemirror;
                        const selection = cm.getSelection();
                        cm.replaceSelection('һ');
                    },
                    text: 'һ',
                    title: 'Insert һ'
                },
                {
                    name: 'buryat-o',
                    action: function(editor) {
                        const cm = editor.codemirror;
                        const selection = cm.getSelection();
                        cm.replaceSelection('Ө');
                    },
                    text: 'Ө',
                    title: 'Insert Ө'
                },
                {
                    name: 'buryat-o-small',
                    action: function(editor) {
                        const cm = editor.codemirror;
                        const selection = cm.getSelection();
                        cm.replaceSelection('ө');
                    },
                    text: 'ө',
                    title: 'Insert ө'
                }
            ]
        });
        JS
);
?>
<div class="news-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <?= $form->field($model, 'active')->checkbox(); ?>
    <?= $form->field($model, 'title')->widget(
        InputWithBuryatLetters::class,
        ['options' => ['maxlength' => true]]
    ); ?>
    <?= $form->field($model, 'description')->widget(
        TextareaWithBuryatLetters::class,
        ['options' => ['rows' => 5]]
    ); ?>
    <?= $form->field($model, 'content')->textarea(['class' => 'markdown-editor']); ?>
    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord
                ? Html::icon('plus') . ' Добавить'
                : Html::icon('floppy-disk') . ' Сохранить',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
