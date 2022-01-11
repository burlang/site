<?php

use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\models\Book $model
 */
?>
<div class="col-sm-4">
    <div class="book-item">
        <h2>
            <?= Html::a(Html::encode($model->title), ['book/view', 'slug' => $model->slug]) ?>
        </h2>
        <?php if (!$model->active): ?>
            <p>
                <span class="label label-default">Неактивный</span>
            </p>
        <?php endif ?>
        <p><?= nl2br(Html::encode($model->description)) ?></p>

        <?= Html::a(
            'Читать →',
            ['/book/view', 'slug' => $model->slug],
            ['class' => 'btn btn-custom btn-sm']
        ) ?>
    </div>
</div>
