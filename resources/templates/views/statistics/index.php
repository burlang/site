<?php

use yii\web\View;

/**
 * @var View $this
 * @var array $buryatWords
 * @var array $russianWords
 * @var array $names
 */

$this->title = 'Статистика';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statistics-index">
    <h1 class="hidden-xs"><?= $this->title ?></h1>
    <?= $this->render('_menu') ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Бурятские слова</h1>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge"><?= $buryatWords['amount'] ?></span>
                        Количество
                    </li>
                    <li class="list-group-item">
                        <span class="badge"><?= $buryatWords['amountTranslations'] ?></span>
                        Количество переводов
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Русские слова</h1>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge"><?= $russianWords['amount'] ?></span>
                        Количество
                    </li>
                    <li class="list-group-item">
                        <span class="badge"><?= $russianWords['amountTranslations'] ?></span>
                        Количество переводов
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Имена</h1>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge"><?= $names['amount'] ?></span>
                        Количество
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
