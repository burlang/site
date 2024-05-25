<?php

use app\models\News;
use app\widgets\Comments;
use yii\bootstrap\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Markdown;
use yii\web\View;

/**
 * @var View $this
 * @var News $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">
    <h1 class="hidden-xs"><?= Html::encode($this->title) ?></h1>
    <?php if (!$model->active): ?>
        <p>
            <span class="label label-default">Неактивный</span>
        </p>
    <?php endif ?>
    <?php if (Yii::$app->user->can('news_management')): ?>
        <p>
            <?= Html::a(
                Html::icon('pencil') . ' Редактировать',
                ['update', 'id' => $model->id],
                ['class' => 'btn btn-primary']
            ) ?>
            <?= Html::a(Html::icon('trash') . ' Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif ?>
    <p><?= Yii::$app->formatter->asDate($model->created_at) ?></p>
    <div class="image-responsive-container">
        <?= HtmlPurifier::process(Markdown::process($model->content, 'gfm')) ?>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="mt-20 comment-block">
                <?= Comments::widget() ?>
            </div>
        </div>
    </div>
</div>
