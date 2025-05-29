<?php

use yii\web\View;

/**
 * @var View $this
 * @var string $textarea
 * @var string $selector
 * @var string $widgetId
 */

$js = <<<JS
    $('#$widgetId').on('click', '.add-textarea-letter-{$selector}', function () {
        const textToInsert = \$(this).text();
        const \$target = $('#{$selector}');
        const input = \$target[0];

        if (!input || typeof input.selectionStart !== 'number') return;

        const start = input.selectionStart;
        const end = input.selectionEnd;

        input.setRangeText(textToInsert, start, end, 'end');

        input.focus();
        input.dispatchEvent(new Event('input', { bubbles: true }));
    });
JS;
$this->registerJs($js, View::POS_READY);
?>
<div class="well well-sm mb-0" id="<?= $widgetId ?>">
    <div class="form-group">
        <?= $textarea ?>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-default add-textarea-letter-<?= $selector ?>">Ү</button>
        <button type="button" class="btn btn-default add-textarea-letter-<?= $selector ?>">ү</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-default add-textarea-letter-<?= $selector ?>">Һ</button>
        <button type="button" class="btn btn-default add-textarea-letter-<?= $selector ?>">һ</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-default add-textarea-letter-<?= $selector ?>">Ө</button>
        <button type="button" class="btn btn-default add-textarea-letter-<?= $selector ?>">ө</button>
    </div>
</div>
