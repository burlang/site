<?php

declare(strict_types=1);

namespace app\widgets;

use app\assets\SendKeysAsset;
use yii\helpers\Html;
use yii\widgets\InputWidget;

final class InputWithBuryatLetters extends InputWidget
{
    public function run(): string
    {
        SendKeysAsset::register($this->view);

        $this->options['class'] = 'form-control';

        $textInput = $this->hasModel()
            ? Html::activeTextInput($this->model, $this->attribute, $this->options)
            : Html::textInput($this->name, $this->value, $this->options);

        return $this->render('@templates/widgets/input-with-buryat-letters', [
            'textInput' => $textInput,
        ]);
    }
}
