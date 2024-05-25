<?php

use app\models\BuryatName;
use yii\bootstrap\Html;
use yii\web\View;

/**
 * @var View $this
 * @var BuryatName $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Бурятские имена', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buryat-name-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <div>
        <?= Html::a(
            Html::icon('pencil') . ' Редактировать',
            ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary']
        ) ?>
        <?= Html::a(
            Html::icon('trash') . ' Удалить',
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить?',
                    'method' => 'post',
                ],
            ]
        ) ?>
    </div>
    <div class="alert alert-success mt-10">
        <h4><strong><?= $model->description ?></strong></h4>
        <?php if ($model->note): ?>
            <p><?= $model->note ?></p>
        <?php endif ?>
        <div class="mt-10">
            <?php if ($model->male): ?>
                <span class="label label-default">Мужское имя</span>
            <?php endif ?>
            <?php if ($model->female): ?>
                <span class="label label-default">Женское имя</span>
            <?php endif ?>
        </div>
    </div>
</div>
