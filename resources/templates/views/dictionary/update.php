<?php

use app\models\Dictionary;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Dictionary $model
 */

$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Словари', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
