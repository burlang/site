<?php

declare(strict_types=1);

use app\components\Translator\TranslationResult;
use app\models\BuryatWord;
use app\models\RussianWord;
use yii\helpers\Html;

/**
 * @var string $q
 * @var BuryatWord[]|RussianWord[] $words
 * @var TranslationResult|null $googleTranslation
 */
?>
<?php if ($q): ?>
    <div class="search-results">

        <div class="search-block">
            <?php if ($words): ?>
                <?php foreach ($words as $word): ?>
                    <div class="word-card">
                        <div class="word-card__term"><?= Html::encode($word->name); ?></div>
                        <div class="word-card__translations">
                            <?php foreach ($word->translations as $t): ?>
                                <span class="word-card__translation"><?= Html::encode($t->name); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="search-empty">
                    По запросу <strong>«<?= Html::encode($q); ?>»</strong> в словаре ничего не найдено
                </div>
            <?php endif; ?>
        </div>

        <?php if ($googleTranslation !== null && $googleTranslation->text !== null): ?>
            <div class="search-block search-block--translate">
                <div class="translate-card">
                    <span class="translate-card__source"><?= Html::encode($q); ?></span>
                    <span class="translate-card__arrow">→</span>
                    <span class="translate-card__result"><?= Html::encode($googleTranslation->text); ?></span>
                    <span class="translate-card__badge">
                        <span style="color:#4285f4">G</span><span style="color:#ea4335">o</span><span style="color:#fbbc05">o</span><span style="color:#4285f4">g</span><span style="color:#34a853">l</span><span style="color:#ea4335">e</span>
                        <span class="translate-card__badge-text">Translate</span>
                    </span>
                </div>
            </div>
        <?php endif; ?>

    </div>
<?php endif; ?>
