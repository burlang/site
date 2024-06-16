<?php

declare(strict_types=1);

use app\widgets\MailTo;
use yii\web\View;

/**
 * @var View $this
 */
$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>

<div class="mt-20">
    <h5><b>Email:</b> <?= MailTo::widget(['email' => 'info@burlang.org']) ?></h5>
</div>
<hr>
<div class="row">
    <div class="col-md-4">
        <h4>Булат Дамдинов</h4>
        <?= MailTo::widget(['email' => 'bulat@damdinov.me']) ?>
    </div>
    <div class="col-md-4">
        <h4>Баир Дармаев</h4>
        <?= MailTo::widget(['email' => 'bairdarmaev@gmail.com']) ?>
    </div>
</div>
