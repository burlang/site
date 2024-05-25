<?php

use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Menu;

/**
 * @var View $this
 */

$this->title = 'Api v1';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="v1-default-index">
    <h1><?= $this->title ?></h1>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                Имена
            </h4>
        </div>
        <div class="panel-body">
            <?= Menu::widget([
                'items' => [
                    ['label' => Url::to(['/api/v1/buryat-name/index'], true)],
                    ['label' => Url::to(['/api/v1/buryat-name/search', 'q' => 'begin_search_name'], true)],
                    ['label' => Url::to(['/api/v1/buryat-name/get-name', 'q' => 'Name'], true)]
                ],
                'labelTemplate' => '<code>{label}</code>',
            ]) ?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                Бурятские слова
            </h4>
        </div>
        <div class="panel-body">
            <?= Menu::widget([
                'items' => [
                    ['label' => Url::to(['/api/v1/buryat-word/search', 'q' => 'begin_search_word'], true)],
                    ['label' => Url::to(['/api/v1/buryat-word/translate', 'q' => 'Word'], true)]
                ],
                'labelTemplate' => '<code>{label}</code>',
            ]) ?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                Русские слова
            </h4>
        </div>
        <div class="panel-body">
            <?= Menu::widget([
                'items' => [
                    ['label' => Url::to(['/api/v1/russian-word/search', 'q' => 'begin_search_word'], true)],
                    ['label' => Url::to(['/api/v1/russian-word/translate', 'q' => 'Word'], true)]
                ],
                'labelTemplate' => '<code>{label}</code>',
            ]) ?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                Новости
            </h4>
        </div>
        <div class="panel-body">
            <?= Menu::widget([
                'items' => [
                    ['label' => Url::to(['/api/v1/news/index', 'page' => 1], true)],
                    ['label' => Url::to(['/api/v1/news/get-news', 'q' => 'slug'], true)]
                ],
                'labelTemplate' => '<code>{label}</code>',
            ]) ?>
        </div>
    </div>
</div>
