<?php

use yii\web\View;
use yii\widgets\Menu;

/**
 * @var View $this
 */
?>
<?= Menu::widget([
    'items' => [
        [
            'label' => 'Данные',
            'url' => ['index'],
            'active' => Yii::$app->controller->action->id === 'index',
        ],
        [
            'label' => 'Поиск',
            'url' => ['search'],
            'active' => Yii::$app->controller->action->id === 'search',
        ],
    ],
    'options' => [
        'class' => 'nav nav-tabs',
    ],
]) ?>
<br>
