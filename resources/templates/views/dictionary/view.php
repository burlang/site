<?php

use app\models\Dictionary;
use yii\bootstrap\Html;
use yii\web\View;
use yii\widgets\DetailView;

/**
 * @var View $this
 * @var Dictionary $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Словари', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dictionary-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(
            Html::icon('pencil') . ' Редактировать',
            ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary']
        ) ?>
        <?= Html::a(Html::icon('trash') . ' Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'info',
                'isbn',
            ],
        ]) ?>
    </div>
</div>
