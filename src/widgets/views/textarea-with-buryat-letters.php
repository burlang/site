<?php

use yii\web\View;

/**
 * @var View $this
 * @var string $textarea
 * @var string $selector
 */

$this->registerJs("
    $('body').on('click', '.add-letter-{$selector}', function() {
        $('#{$selector}').sendkeys($(this).text());
    });
");
?>
<div class="well well-sm mb-0">
    <div class="form-group">
        <?= $textarea ?>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-default add-letter-<?= $selector ?>">Ү</button>
        <button type="button" class="btn btn-default add-letter-<?= $selector ?>">ү</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-default add-letter-<?= $selector ?>">Һ</button>
        <button type="button" class="btn btn-default add-letter-<?= $selector ?>">һ</button>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-default add-letter-<?= $selector ?>">Ө</button>
        <button type="button" class="btn btn-default add-letter-<?= $selector ?>">ө</button>
    </div>
</div>