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
            'active' => isRouteActive('statistics/index'),
        ],
        [
            'label' => 'Поиск',
            'url' => ['search'],
            'active' => isRouteActive('statistics/search'),
        ],
    ],
    'options' => [
        'class' => 'nav nav-tabs',
    ],
]); ?>
<br>
