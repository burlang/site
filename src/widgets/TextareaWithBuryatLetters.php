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
            /** @var Model $model */
            $model = $this->model;
            $textarea = Html::activeTextArea($model, (string)$this->attribute, $this->options);
            $selector = strtolower($model->formName()) . '-' . $this->attribute;
        } else {
            $textarea = Html::textArea((string)$this->name, $this->value, $this->options);
            $selector = "charts-textarea-{$this->name}";
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
