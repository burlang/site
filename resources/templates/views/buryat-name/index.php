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
    <h1><?= Html::encode($this->title); ?></h1>
    <hr>
    
    <!-- НАЧАЛО: Поисковая форма -->
    <div class="name-search mb-30">
        <form
            hx-get="<?= Url::to(['/buryat-name/search']); ?>"
            hx-target="[hx-target='name-list']"
            hx-trigger="submit, keyup delay:300ms changed"
            hx-indicator="#search-indicator"
            class="form-inline"
        >
            <div class="input-group" style="width: 100%; max-width: 500px;">
                <input
                    type="text"
                    name="q"
                    class="form-control input-lg"
                    placeholder="Введите бурятское или русское имя, значение..."
                    value="<?= Html::encode($searchQuery ?? '') ?>"
                >
                <span class="input-group-btn">
                    <button class="btn btn-primary btn-lg" type="submit">
                        <span class="glyphicon glyphicon-search"></span> Найти
                    </button>
                </span>
            </div>
            <span id="search-indicator" class="htmx-indicator" style="margin-left: 10px;">
                <small>Ищем...</small>
            </span>
        </form>
        <p class="help-block">
            Ищите по самому имени, его описанию или заметке. Например, "Баяр" или "радость".
        </p>
    </div>
    <!-- КОНЕЦ: Поисковая формы -->
    
    <?php if ($letters): ?>
        <ul class="list-inline list-letter">
            <?php foreach ($letters as $letter => $amount): ?>
                <li>
                    <?= Html::a(
                        $letter . ' ' . Html::tag('span', (string)$amount, ['class' => 'badge']),
                        ['/buryat-name/letter', 'letter' => $letter],
                        [
                            'class' => 'btn btn-default btn-lg',
                            'style' => 'width: 85px;',
                        ]
                    ); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <hr>
   <div hx-get="<?= Url::to(['/buryat-name/list']); ?>" hx-trigger="load" hx-target="name-list">
        <p class="text-center">Загрузка имен...</p>
    </div>
</div>
