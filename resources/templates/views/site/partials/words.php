<?php

declare(strict_types=1);

use app\models\BuryatWord;
use app\models\RussianWord;
use yii\helpers\Html;

/**
 * @var string $q
 * @var RussianWord[]|BuryatWord[] $words
 */
?>
<?php if ($q): ?>
    <?php if ($words): ?>
        <?php foreach ($words as $word): ?>
            <div class="alert alert-success mt-20 mb-0">
                <b><?= Html::encode($word->name) ?></b>
                <ul>
                    <?php foreach ($word->translations as $translation): ?>
                        <li><?= Html::encode($translation->name) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endforeach ?>
    <?php else: ?>
        <div class="alert alert-danger mt-20 mb-0">
            Подходящие слова не найдены
        </div>
    <?php endif ?>
<?php endif ?>
