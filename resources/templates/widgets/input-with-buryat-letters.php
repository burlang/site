<?php

use yii\web\View;

/**
 * @var View $this
 * @var string $textInput
 * @var string $widgetId
 */
$js = <<<JS
        $('#{$widgetId} button.add-input-letter').on('click', function () {
            let \$this = \$(this);
            let \$input = \$this.parent('span').siblings('input');
            let input = \$input[0];

            let textToInsert = \$this.text();
            let end = input.selectionEnd;
            let start = input.selectionStart;

            input.setRangeText(textToInsert, start, end, 'end');

            input.focus();
            input.dispatchEvent(new Event('input', { bubbles: true }));
        });
    JS;
$this->registerJs($js, View::POS_READY);
?>
<div class="input-group" id="<?= $widgetId; ?>">
    <?= $textInput; ?>
    <span class="input-group-btn">
        <button type="button" class="btn btn-default add-input-letter">ү</button>
        <button type="button" class="btn btn-default add-input-letter">һ</button>
        <button type="button" class="btn btn-default add-input-letter">ө</button>
    </span>
</div>
