<?php

declare(strict_types=1);

use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>

<div class="row mt-20">
    <div class="col-md-4">
        <h4>Булат Дамдинов</h4>
        <?= Html::mailto('bulat@damdinov.me') ?>
    </div>
    <div class="col-md-4">
        <h4>Баир Дармаев</h4>
        <?= Html::mailto('bairdarmaev@gmail.com') ?>
    </div>
</div>
