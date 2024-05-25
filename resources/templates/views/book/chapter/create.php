<?php

use app\models\Book;
use app\models\BookChapter;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var BookChapter $chapter
 * @var Book $book
 */

$this->title = 'Добавить главу';
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $book->title, 'url' => ['view', 'slug' => $book->slug]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'chapter' => $chapter,
    ]) ?>

</div>
