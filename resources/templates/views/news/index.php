<?php

use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\ListView;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <h1 class="hidden-xs"><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->user->can('news_management')): ?>
        <p>
            <?= Html::a(
                Html::icon('plus') . ' Создать новость',
                ['create'],
                ['class' => 'btn btn-success']
            ) ?>
        </p>
    <?php endif ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'itemView' => '_view',
    ]) ?>
</div>
