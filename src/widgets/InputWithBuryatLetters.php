<?php

declare(strict_types=1);

namespace app\widgets;

use yii\widgets\InputWidget;

final class InputWithBuryatLetters extends InputWidget
{
    public function run(): string
    {
        $this->options['class'] = 'form-control';

        $textInput = $this->renderInputHtml('text');
        $widgetId = $this->getId() . '-wrapper';

        return $this->render('@templates/widgets/input-with-buryat-letters', [
            'textInput' => $textInput,
            'widgetId' => $widgetId,
        ]);
    }
}
