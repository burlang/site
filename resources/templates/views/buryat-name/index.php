<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var array<string, int> $letters
 * @var string[] $names
 */

$this->title = 'Бурятские имена';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buryat-name-list">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <?php if ($letters): ?>
        <ul class="list-inline list-letter">
            <?php foreach ($letters as $letter => $amount): ?>
                <li class="mb-5">
                    <?= Html::a(
                        $letter . ' ' . Html::tag('span', $amount, ['class' => 'badge']),
                        ['/buryat-name/letter', 'letter' => $letter],
                        [
                            'class' => 'btn btn-default btn-lg',
                            'style' => 'width: 85px;',
                        ]
                    ) ?>
                </li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
    <hr>
    <div hx-get="<?= Url::to(['/buryat-name/list']) ?>" hx-trigger="load">
        <p class="text-center">Загрузка имен...</p>
    </div>
</div>
