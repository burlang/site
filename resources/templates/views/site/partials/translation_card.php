<?php

declare(strict_types=1);

use app\components\Translator\TranslationProvider;
use app\components\Translator\TranslationResult;
use yii\helpers\Html;

/**
 * @var string $q
 * @var TranslationResult|null $translation
 */
?>
<?php if ($translation !== null && $translation->text !== null): ?>
    <div class="search-block search-block__translate">
        <div class="translate-card">
            <span class="translate-card__source"><?= Html::encode($q); ?></span>
            <span class="translate-card__arrow">→</span>
            <span class="translate-card__result"><?= Html::encode($translation->text); ?></span>
            <span class="translate-card__badge">
                <?php if ($translation->provider === TranslationProvider::Yandex): ?>
                    <span class="translate-card__badge-text"><span style="color:#FC3F1D;font-weight:600">Yandex</span> Translate</span>
                <?php elseif ($translation->provider === TranslationProvider::Google): ?>
                    <span style="color:#4285f4">G</span><span style="color:#ea4335">o</span><span style="color:#fbbc05">o</span><span style="color:#4285f4">g</span><span style="color:#34a853">l</span><span style="color:#ea4335">e</span>
                    <span class="translate-card__badge-text">Translate</span>
                <?php endif; ?>
            </span>
        </div>
    </div>
<?php endif; ?>
