<?php

use app\models\Book;
use yii\bootstrap\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Book $model
 */
?>
<?php if (!$model->active): ?>
    <p><span class="label label-default">Неактивный</span></p>
<?php endif ?>
<?php if (Yii::$app->user->can('book_management')): ?>
    <p>
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
    </p>
<?php endif ?>
