<?php

use yii\bootstrap\Html;
use yii\widgets\ListView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title =  'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <h1 class="hidden-xs"><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->user->can('adminNews')): ?>
        <p>
            <?= Html::a(
                Html::icon('plus')  .  ' Создать новость',
                ['create'],
                ['class' => 'btn btn-success']
            ) ?>
        </p>
    <?php endif ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'itemView' => '_view'
    ]) ?>
</div>
