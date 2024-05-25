<?php

use app\models\Book;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var Book $model
 */

$this->title = 'Создать книгу';
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
