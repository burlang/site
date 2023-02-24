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
                hx-get="<?= Url::to(['site/russian-words-form']) ?>"
                hx-trigger="click"
                hx-target="#buryat-words-form"
                hx-swap="outerHTML"
        >
            <img src="<?= Yii::getAlias('@web/icon/arrow-left-right.svg') ?>" alt="switch">
        </button>
        Русский словарь
        <span class="htmx-indicator">
            <img src="<?= Yii::getAlias('@web/icon/loader.svg') ?>" alt="Поиск...">
        </span>
    </h3>
    <hr>
    <?php $form = ActiveForm::begin([
        'action' => ['/site/find-buryat-words'],
        'method' => 'get',
    ]) ?>
    <div class="input-group">
        <input name="q" type="search" required="required" autocomplete="off"
               id="bur-search" class="form-control input-lg"
               placeholder="Введите бурятское слово"
               onkeydown="return (event.keyCode!==13);"
               hx-get="<?= Url::to(['/site/find-buryat-words']) ?>"
               hx-trigger="keyup changed delay:500ms, search"
               hx-target="#buryat-words"
               hx-indicator=".htmx-indicator"
        >
        <span class="input-group-btn">
            <?php foreach (['ү', 'һ', 'ө'] as $letter): ?>
                <button type="button" class="btn btn-default btn-lg bur-letter"
                        _="on click
                        set #bur-search.value to #bur-search.value + my.innerText
                        call htmx.trigger('#bur-search', 'keyup')
                        call #bur-search.focus()">
                    <?= $letter ?>
                </button>
            <?php endforeach ?>
        </span>
    </div>
    <?php ActiveForm::end() ?>
    <div id="buryat-words"></div>
</div>
