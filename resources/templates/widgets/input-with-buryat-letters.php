<?php

use yii\web\View;

/**
 * @var string $textInput
 * @var View $this
 */

$this->registerJs(<<<'JS'
    $('button.add-input-letter').on('click', function () {
        let $this = $(this);
        let $input = $this.parent('span').siblings('input');
        $input.val($input.val() + $this.text());
    });
JS
);
?>
<div class="input-group">
    <?= $textInput ?>
    <span class="input-group-btn">
        <button type="button" class="btn btn-default add-input-letter">ү</button>
        <button type="button" class="btn btn-default add-input-letter">һ</button>
        <button type="button" class="btn btn-default add-input-letter">ө</button>
    </span>
</div>
