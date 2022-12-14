<?php

namespace app\widgets;

use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\widgets\InputWidget;

class TextareaWithBuryatLetters extends InputWidget
{
    /**
     * {@inheritDoc}
     */
    public function run(): string
    {
        if ($this->hasModel()) {
            $textarea = Html::activeTextArea($this->model, $this->attribute, $this->options);
            $selector = Inflector::camel2id($this->model->formName()) . '-' . $this->attribute;
        } else {
            $textarea = Html::textArea($this->name, $this->value, $this->options);
            $selector = 'charts-textarea-' . $this->name;
        }

        $this->options['class'] = 'form-control';
        $this->options['id'] = $selector;

        $this->view->registerJs("
            $('body').on('click', '.add-letter-{$selector}', function() {
                $('#{$selector}').sendkeys($(this).text());
            });
        ");

        return $this->render('textarea-with-buryat-letters', [
            'textarea' => $textarea,
            'selector' => $selector,
        ]);
    }
}
