<?php

declare(strict_types=1);

namespace app\controllers;

use app\components\Translator\GoogleTranslator;
use app\components\Translator\TranslationProvider;
use app\components\Translator\YandexTranslator;
use app\models\BuryatWord;
use app\models\RussianWord;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ErrorAction;

class SiteController extends Controller
{
    private const int SEARCH_LIMIT = 5;

    public function actions(): array
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
                    'contacts' => ['GET'],
                    'russian-words-form' => ['GET'],
                    'buryat-words-form' => ['GET'],
                    'find-russian-words' => ['GET'],
                    'find-buryat-words' => ['GET'],
                    'translate-russian' => ['POST'],
                    'translate-buryat' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    public function actionContacts(): string
    {
        return $this->render('contacts');
    }

    public function actionBuryatWordsForm(string $q = ''): string
    {
        return $this->renderPartial('partials/buryat_words_form', ['q' => $q]);
    }

    public function actionRussianWordsForm(string $q = ''): string
    {
        return $this->renderPartial('partials/russian_words_form', ['q' => $q]);
    }

    public function actionFindRussianWords(string $q): string
    {
        $q = trim($q);
        $words = RussianWord::find()
            ->with('translations')
            ->filterWhere(['like', 'name', "{$q}%", false])
            ->orderBy('name')
            ->limit(self::SEARCH_LIMIT)
            ->all();

        return $this->renderPartial('partials/words', [
            'q' => $q,
            'words' => $words,
            'googleTranslateUrl' => Url::to(['/site/translate-russian', 'q' => $q, 'provider' => TranslationProvider::Google->value]),
            'yandexTranslateUrl' => Url::to(['/site/translate-russian', 'q' => $q, 'provider' => TranslationProvider::Yandex->value]),
        ]);
    }

    public function actionFindBuryatWords(string $q): string
    {
        $q = trim($q);
        $words = BuryatWord::find()
            ->with('translations')
            ->filterWhere(['like', 'name', "{$q}%", false])
            ->orderBy('name')
            ->limit(self::SEARCH_LIMIT)
            ->all();

        return $this->renderPartial('partials/words', [
            'q' => $q,
            'words' => $words,
            'googleTranslateUrl' => Url::to(['/site/translate-buryat', 'q' => $q, 'provider' => TranslationProvider::Google->value]),
            'yandexTranslateUrl' => Url::to(['/site/translate-buryat', 'q' => $q, 'provider' => TranslationProvider::Yandex->value]),
        ]);
    }

    public function actionTranslateRussian(string $q, string $provider, GoogleTranslator $googleTranslator, YandexTranslator $yandexTranslator): string
    {
        $q = trim($q);
        $translationProvider = TranslationProvider::tryFrom($provider)
            ?? throw new BadRequestHttpException("Unsupported provider: {$provider}");

        $translation = match ($translationProvider) {
            TranslationProvider::Yandex => $q !== '' ? $yandexTranslator->translateToBuryat($q) : null,
            TranslationProvider::Google => $q !== '' ? $googleTranslator->translateToBuryat($q) : null,
        };

        return $this->renderPartial('partials/translation_card', [
            'q' => $q,
            'translation' => $translation,
        ]);
    }

    public function actionTranslateBuryat(string $q, string $provider, GoogleTranslator $googleTranslator, YandexTranslator $yandexTranslator): string
    {
        $q = trim($q);
        $translationProvider = TranslationProvider::tryFrom($provider)
            ?? throw new BadRequestHttpException("Unsupported provider: {$provider}");

        $translation = match ($translationProvider) {
            TranslationProvider::Yandex => $q !== '' ? $yandexTranslator->translateToRussian($q) : null,
            TranslationProvider::Google => $q !== '' ? $googleTranslator->translateToRussian($q) : null,
        };

        return $this->renderPartial('partials/translation_card', [
            'q' => $q,
            'translation' => $translation,
        ]);
    }
}
