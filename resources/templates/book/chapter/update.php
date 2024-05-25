<?php

use app\models\BookChapter;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var BookChapter $chapter
 */

$this->title = 'Редактировать: ' .$chapter->title;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $chapter->book->title, 'url' => ['view', 'slug' => $chapter->book->slug]];
$this->params['breadcrumbs'][] = [
    'label' => $chapter->title,
    'url' => ['chapter', 'slug' => $chapter->book->slug, 'chapterSlug' => $chapter->slug],
];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="book-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'chapter' => $chapter,
    ]) ?>
</div>
