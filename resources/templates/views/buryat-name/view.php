<?php

use app\models\BuryatName;
use yii\bootstrap\Html;
use yii\web\View;

/**
 * @var View $this
 * @var BuryatName $model
 */
$this->title = sprintf('Бурятское имя "%s"', $model->name);
$this->params['breadcrumbs'][] = ['label' => 'Бурятские имена', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="buryat-name-view">
    <h1><?= Html::encode($model->name); ?></h1>
    <div class="well">
        <h4 class="mt-0"><strong><?= $model->description; ?></strong></h4>
        <?php if ($model->note): ?>
            <p><?= $model->note; ?></p>
        <?php endif; ?>
        <div class="mt-10">
            <?php if ($model->male): ?>
                <span class="badge">Мужское имя</span>
            <?php endif; ?>
            <?php if ($model->female): ?>
                <span class="badge">Женское имя</span>
            <?php endif; ?>
        </div>
    </div>
</div>
