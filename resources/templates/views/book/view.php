<?php

use app\models\Book;
use app\widgets\ChaptersMenu;
use yii\bootstrap\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Markdown;
use yii\web\View;

/**
 * @var View $this
 * @var Book $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">
    <h1 class="hidden-xs"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_header', ['model' => $model]) ?>
    <div class="row">
        <div class="col-sm-3">
            <?= ChaptersMenu::widget(['book' => $model]) ?>
        </div>
        <div class="col-sm-9 col-xs-12">
            <div class="image-responsive-container">
                <?= HtmlPurifier::process(Markdown::process($model->content, 'gfm')) ?>
            </div>
        </div>
    </div>
</div>
