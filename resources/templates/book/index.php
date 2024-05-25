<?php

use app\components\DeviceDetector\DeviceDetectorInterface;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\ListView;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var DeviceDetectorInterface $deviceDetector
 */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">
    <h1 class="hidden-xs"><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->user->can('book_management')): ?>
        <p>
            <?= Html::a(
                Html::icon('plus') . ' Создать книгу',
                ['create'],
                ['class' => 'btn btn-success']
            ) ?>
        </p>
    <?php endif ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'layout' => "{summary}\n<div class=\"row\">{items}</div>\n{pager}",
        'itemView' => $deviceDetector->isDesktop() ? '_view' : '_view_mobile',
        'pager' => [
            'maxButtonCount' => $deviceDetector->isDesktop() ? 10 : 5,
        ],
    ]) ?>
</div>
