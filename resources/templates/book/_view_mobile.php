<?php

use app\models\Book;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Book $model
 */
?>
<div class="col-sm-12">
    <div class="book-item-mobile">
        <h2>
            <?= Html::a(
                Html::encode($model->title),
                ['book/view', 'slug' => $model->slug]
            ) ?>
        </h2>
        <?php if (!$model->active): ?>
            <p><span class="label label-default">Неактивный</span></p>
        <?php endif ?>
    </div>
</div>
