<?php

declare(strict_types=1);

use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var string $q
 */
?>
<div class="well" id="russian-words-form">
    <h3>
        Русско
        <button class="btn btn-default btn-sm"
            hx-get="<?= Url::to(['site/buryat-words-form']); ?>"
            hx-trigger="click"
            hx-target="#russian-words-form"
            hx-swap="outerHTML"
            hx-include="#rus-search">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>
            </svg>
        </button>
        Бурятский словарь
    </h3>
    <hr>
    <?php $form = ActiveForm::begin([
        'action' => ['/site/find-russian-words'],
        'method' => 'get',
    ]); ?>
    <input type="search" name="q" placeholder="Введите русское слово" required="required"
        autocomplete="off" class="form-control input-lg" onkeydown="return (event.keyCode!==13);"
        autofocus id="rus-search"
        value="<?= htmlspecialchars($q, ENT_QUOTES); ?>"
        hx-get="<?= Url::to(['/site/find-russian-words']); ?>"
        hx-trigger="keyup changed delay:500ms, search<?= $q !== '' ? ', load' : ''; ?>"
        hx-target="#russian-words"
        hx-indicator="#rus-indicator">
    <?php ActiveForm::end(); ?>
    <div id="rus-indicator" class="htmx-indicator search-indicator"></div>
    <div id="russian-words"></div>
</div>
<script>
    (function () {
        const input = document.getElementById('rus-search');
        const results = document.getElementById('russian-words');

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
