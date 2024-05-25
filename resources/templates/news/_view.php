<?php

use app\models\News;
use yii\helpers\Html;

/**
 * @var News $model
 */
?>
<div class="news-item">
    <h2>
        <?= Html::a(Html::encode($model->title), ['/news/view', 'slug' => $model->slug]) ?>
    </h2>
    <?php if (!$model->active): ?>
        <p>
            <span class="label label-default">Неактивный</span>
        </p>
    <?php endif ?>
    <p><?= Yii::$app->formatter->asDate($model->created_at) ?></p>
    <div class="description">
        <?= nl2br(Html::encode($model->description)) ?>
    </div>
</div>


