<?php

use app\widgets\LastNews;
use yii\web\View;

/**
 * @var View $this
 */
$this->registerJs(
    <<<'JS'
document.getElementById('dictionary-search-form').addEventListener('click', function(event) {
    if (event.target && event.target.classList.contains('bur-letter')) {
        var burSearch = document.getElementById('bur-search');
        burSearch.value += event.target.innerText;
        var eventKeyup = new Event('keyup', {
            bubbles: true,
            cancelable: true,
            view: window
        });
        burSearch.dispatchEvent(eventKeyup);
        burSearch.focus();
    }
});
JS,
    View::POS_END
);
$this->title = Yii::$app->name . ' - Русско-Бурятский, Бурятско-Русский электронный словарь';
?>
<div class="site-index">
    <div class="row mt-10">
        <div class="col-sm-8 mb-10">
            <div id="dictionary-search-form">
                <?= $this->render('partials/buryat_words_form') ?>
            </div>
            <?= $this->render('_buryat_word_bot') ?>
            <div class="text-center mt-20 mb-10">
                Альтернативная версия: <a href="https://buryat-lang.ru" target="_blank" rel="noopener noreferrer">buryat-lang.ru</a>
            </div>
        </div>
        <div class="col-sm-4">
            <?= LastNews::widget() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 mb-10">
            <div class="text-center mt-20 mb-10">
                <a href="https://apps.apple.com/ru/app/burlang/id1669964114" target="_blank" rel="noopener noreferrer">
                    <img src="<?= Yii::getAlias('@web/icon/app-store.svg') ?>" alt="AppStore" height="40">
                </a>
                <a href="https://play.google.com/store/apps/details?id=burlang.ru" target="_blank" rel="noopener noreferrer">
                    <img src="<?= Yii::getAlias('@web/icon/google-play.svg') ?>" alt="GooglePlay" height="40">
                </a>
            </div>
        </div>
    </div>
</div>