<?php

use app\models\News;
use yii\helpers\Html;

/**
 * @var News[] $lastNews
 */
?>
<div class="news-widget">
    <h3>Новости</h3>
    <?php foreach ($lastNews as $news): ?>
        <div class="news-item">
            <h2>
                <?= Html::a(Html::encode($news->title), ['/news/view', 'slug' => $news->slug]) ?>
            </h2>
            <p><?= Yii::$app->formatter->asDate($news->created_at) ?></p>
            <div class="description">
                <?= nl2br(Html::encode($news->description)) ?>
            </div>
        </div>
    <?php endforeach ?>
    <div class="text-right mt-20">
        <?= Html::a('Все новости →', ['/news/index']) ?>
    </div>
</div>
