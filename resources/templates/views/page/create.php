<?php

use app\models\Page;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Page $model
 */

$this->title = 'Создать страницу';
$this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
