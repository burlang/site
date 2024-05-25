<?php

declare(strict_types=1);

use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="well" id="russian-words-form">
    <h3>
        Русско
        <button class="btn btn-default btn-sm"
                hx-get="<?= Url::to(['site/buryat-words-form']) ?>"
                hx-trigger="click"
                hx-target="#russian-words-form"
                hx-swap="outerHTML"
        >
            <img src="<?= Yii::getAlias('@web/icon/arrow-left-right.svg') ?>" alt="">
        </button>
        Бурятский словарь
        <span class="htmx-indicator">
            <img src="<?= Yii::getAlias('@web/icon/loader.svg') ?>" alt="Поиск...">
        </span>
    </h3>
    <hr>
    <?php $form = ActiveForm::begin([
        'action' => ['/site/find-russian-words'],
        'method' => 'get',
    ]) ?>
    <input type="search" name="q" placeholder="Введите русское слово" required="required"
           autocomplete="off" class="form-control input-lg" onkeydown="return (event.keyCode!==13);"
           hx-get="<?= Url::to(['/site/find-russian-words']) ?>"
           hx-trigger="keyup changed delay:500ms, search"
           hx-target="#russian-words"
           hx-indicator=".htmx-indicator"
    >
    <?php ActiveForm::end() ?>
    <div id="russian-words"></div>
</div>
