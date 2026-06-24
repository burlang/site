<?php

declare(strict_types=1);

use app\models\BuryatWord;
use app\models\RussianWord;
use yii\helpers\Html;

/**
 * @var string $q
 * @var BuryatWord[]|RussianWord[] $words
 * @var string $googleTranslateUrl
 * @var string $yandexTranslateUrl
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

        <button type="button" id="translate-trigger" class="btn-translate"
            hx-on:click="this.hidden=true; this.nextElementSibling.hidden=false">
            Перевести через Yandex и Google
        </button>

        <div hidden>
            <div hx-post="<?= $yandexTranslateUrl; ?>" hx-trigger="click from:#translate-trigger" hx-swap="outerHTML">
                <div class="search-block search-block__translate">
                    <div class="translate-card-skeleton">
                        <span class="translate-card-skeleton__source"></span>
                        <span class="translate-card-skeleton__arrow"></span>
                        <span class="translate-card-skeleton__result"></span>
                        <span class="translate-card__badge">
                            <span class="translate-card__badge-text"><span style="color:#FC3F1D;font-weight:600">Yandex</span> Translate</span>
                        </span>
                    </div>
                </div>
            </div>

            <div hx-post="<?= $googleTranslateUrl; ?>" hx-trigger="click from:#translate-trigger" hx-swap="outerHTML">
                <div class="search-block search-block__translate">
                    <div class="translate-card-skeleton">
                        <span class="translate-card-skeleton__source"></span>
                        <span class="translate-card-skeleton__arrow"></span>
                        <span class="translate-card-skeleton__result"></span>
                        <span class="translate-card__badge">
                            <span style="color:#4285f4">G</span><span style="color:#ea4335">o</span><span style="color:#fbbc05">o</span><span style="color:#4285f4">g</span><span style="color:#34a853">l</span><span style="color:#ea4335">e</span>
                            <span class="translate-card__badge-text">Translate</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php endif; ?>
