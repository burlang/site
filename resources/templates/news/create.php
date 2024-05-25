<?php

use app\models\News;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var News $model
 */

$this->title = 'Создать новость';
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">
    <h1 class="hidden-xs"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
