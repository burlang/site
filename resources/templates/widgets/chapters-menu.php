<?php

use app\models\Book;
use yii\bootstrap\Html;

/**
 * @var Book $model
 * @var int|null $activeId
 */
?>
<div class="list-group">
    <?= Html::a(
        'Главная',
        ['view', 'slug' => $model->slug],
        ['class' => $activeId === null ? 'list-group-item active' : 'list-group-item']
    ) ?>
    <?php foreach ($model->chapters as $chapter): ?>
        <?= Html::a(
            Html::encode($chapter->title),
            ['chapter', 'slug' => $chapter->book->slug, 'chapterSlug' => $chapter->slug],
            ['class' => $chapter->id === $activeId ? 'list-group-item active' : 'list-group-item']
        ) ?>
    <?php endforeach ?>
</div>
<?php if (Yii::$app->user->can('book_management')): ?>
    <p>
        <?= Html::a(
            Html::icon('plus') . ' Добавить главу',
            ['chapter-create', 'id' => $model->id],
            ['class' => 'btn btn-sm btn-success']
        ) ?>
    </p>
<?php endif ?>
