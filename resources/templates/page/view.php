<?php

use app\models\Page;
use app\widgets\Comments;
use yii\bootstrap\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Markdown;
use yii\web\View;

/**
 * @var View $this
 * @var Page $model
 */

$this->title = $model->title;
if (Yii::$app->user->can('pages_management')) {
    $this->params['breadcrumbs'][] = ['label' => 'Страницы', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">
    <h1>
        <?= Html::encode($this->title) ?>
    </h1>
    <?php if (!$model->active): ?>
        <p>
            <span class="label label-default">Неактивный</span>
        </p>
    <?php endif ?>
    <?php if (Yii::$app->user->can('pages_management')): ?>
        <p>
            <?= Html::a(
                Html::icon('pencil') . ' Редактировать',
                ['update', 'id' => $model->id],
                ['class' => 'btn btn-primary']
            ) ?>
            <?php if (!$model->static): ?>
                <?= Html::a(Html::icon('trash') . ' Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить?',
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif ?>
        </p>
    <?php endif ?>
    <div class="image-responsive-container">
        <?= HtmlPurifier::process(Markdown::process($model->content, 'gfm')) ?>
    </div>
</div>
