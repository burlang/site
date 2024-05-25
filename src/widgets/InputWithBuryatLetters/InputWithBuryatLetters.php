<?php

namespace app\widgets\InputWithBuryatLetters;

use yii\helpers\Html;
use yii\widgets\InputWidget;

final class InputWithBuryatLetters extends InputWidget
{
    public function init()
    {
        InputWithBuryatLettersAsset::register($this->getView());
        parent::init();
    }

    /**
     * {@inheritDoc}
     */
    public function run(): string
    {
        $this->options['class'] = 'form-control';

        $textInput = $this->hasModel()
            ? Html::activeTextInput($this->model, $this->attribute, $this->options)
            : Html::textInput($this->name, $this->value, $this->options);

        return $this->render('input-with-buryat-letters', [
            'textInput' => $textInput,
        ]);
    }
}
