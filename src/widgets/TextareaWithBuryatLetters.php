<?php

declare(strict_types=1);

namespace app\widgets;

use yii\base\Model;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class TextareaWithBuryatLetters extends InputWidget
{
    public function run(): string
    {
        if ($this->hasModel()) {
            $textarea = Html::activeTextArea($this->model, $this->attribute, $this->options);
            /** @var Model $model */
            $model = $this->model;
            $selector = strtolower($model->formName()) . '-' . $this->attribute;
        } else {
            $textarea = Html::textArea($this->name, $this->value, $this->options);
            $selector = 'charts-textarea-' . $this->name;
        }

        $this->options['class'] = 'form-control';
        $this->options['id'] = $selector;

        $widgetId = $this->getId() . '-wrapper';

        return $this->render('@templates/widgets/textarea-with-buryat-letters', [
            'textarea' => $textarea,
            'selector' => $selector,
            'widgetId' => $widgetId,
        ]);
    }
}
