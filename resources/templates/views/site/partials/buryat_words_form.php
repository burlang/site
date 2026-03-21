<?php

declare(strict_types=1);

use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 */
?>
<div class="well" id="buryat-words-form">
    <h3>
        Бурятско
        <button class="btn btn-default btn-sm"
            hx-get="<?= Url::to(['site/russian-words-form']); ?>"
            hx-trigger="click"
            hx-target="#buryat-words-form"
            hx-swap="outerHTML">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>
            </svg>
        </button>
        Русский словарь
    </h3>
    <hr>
    <?php $form = ActiveForm::begin([
        'action' => ['/site/find-buryat-words'],
        'method' => 'get',
    ]); ?>
    <div class="input-group">
        <input name="q" type="search" required="required" autocomplete="off"
            id="bur-search" class="form-control input-lg"
            placeholder="Введите бурятское слово"
            autofocus
            onkeydown="return (event.keyCode!==13);"
            hx-get="<?= Url::to(['/site/find-buryat-words']); ?>"
            hx-trigger="keyup changed delay:500ms, search"
            hx-target="#buryat-words"
            hx-indicator="#bur-indicator">
        <span class="input-group-btn">
            <button type="button" class="btn btn-default btn-lg bur-letter">ү</button>
            <button type="button" class="btn btn-default btn-lg bur-letter">һ</button>
            <button type="button" class="btn btn-default btn-lg bur-letter">ө</button>
        </span>
    </div>
    <?php ActiveForm::end(); ?>
    <div id="bur-indicator" class="htmx-indicator search-indicator"></div>
    <div id="buryat-words"></div>
</div>
<script>
    (function () {
        const input = document.getElementById('bur-search');
        const results = document.getElementById('buryat-words');

        document.addEventListener('htmx:beforeRequest', function (e) {
            if (e.detail.elt !== input) return;
            if (!input.value.trim()) {
                results.innerHTML = '';
                e.preventDefault();
            }
        });

        document.addEventListener('htmx:responseError', function (e) {
            if (e.detail.elt !== input) return;
            results.innerHTML = '<div class="search-empty">Произошла ошибка при загрузке данных</div>';
        });
    }());
</script>
