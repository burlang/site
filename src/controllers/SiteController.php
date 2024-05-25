<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\BuryatWord;
use app\models\RussianWord;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ErrorAction;

class SiteController extends Controller
{
    private const SEARCH_LIMIT = 5;

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

    public function actionBuryatWordsForm(): string
    {
        return $this->renderPartial('partials/buryat_words_form');
    }

    public function actionRussianWordsForm(): string
    {
        return $this->renderPartial('partials/russian_words_form');
    }

    public function actionFindRussianWords(string $q): string
    {
        $q = trim($q);
        $words = RussianWord::find()
            ->with('translations')
            ->filterWhere(['like', 'name', $q . '%', false])
            ->orderBy('name')
            ->limit(self::SEARCH_LIMIT)
            ->all();

        return $this->renderPartial('partials/words', [
            'q' => $q,
            'words' => $words,
        ]);
    }

    public function actionFindBuryatWords(string $q): string
    {
        $q = trim($q);
        $words = BuryatWord::find()
            ->with('translations')
            ->filterWhere(['like', 'name', $q . '%', false])
            ->orderBy('name')
            ->limit(self::SEARCH_LIMIT)
            ->all();

        return $this->renderPartial('partials/words', [
            'q' => $q,
            'words' => $words,
        ]);
    }
}
