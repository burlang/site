<?php

use app\widgets\Comments;
use app\widgets\LastNews;
use yii\web\View;

/**
 * @var View $this
 */

$this->title = Yii::$app->name . ' - Русско-Бурятский, Бурятско-Русский электронный словарь';
?>
<div class="site-index">
    <div class="row mt-10">
        <div class="col-sm-8">
            <?= $this->render('partials/buryat_words_form') ?>
            <hr>
            <div class="text-center mt-20">
                <a href="https://apps.apple.com/ru/app/burlang/id1669964114" target="_blank" rel="noopener noreferrer">
                    <img src="<?= Yii::getAlias('@web/icon/app-store.svg') ?>" alt="AppStore" height="40">
                </a>
                <a href="https://play.google.com/store/apps/details?id=burlang.ru"  target="_blank" rel="noopener noreferrer">
                    <img src="<?= Yii::getAlias('@web/icon/google-play.svg') ?>" alt="GooglePlay" height="40">
                </a>
            </div>
            <?= Comments::widget() ?>
        </div>
        <div class="col-sm-4">
            <?= LastNews::widget() ?>
        </div>
    </div>
</div>
