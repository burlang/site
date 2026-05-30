<?php

declare(strict_types=1);

namespace app\controllers;

use app\enums\PermissionEnum;
use app\models\BuryatName;
use app\models\BuryatTranslation;
use app\models\BuryatWord;
use app\models\RussianTranslation;
use app\models\RussianWord;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class StatisticsController extends Controller
{
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'index',
                        ],
                        'roles' => [PermissionEnum::STATISTICS_VIEW->value],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $buryatWords = [];
        $buryatWords['amount'] = BuryatWord::find()->count();
        $buryatWords['amountTranslations'] = BuryatTranslation::find()->count();

        $russianWords = [];
        $russianWords['amount'] = RussianWord::find()->count();
        $russianWords['amountTranslations'] = RussianTranslation::find()->count();

        $names = [];
        $names['amount'] = BuryatName::find()->count();

        return $this->render('index', [
            'buryatWords' => $buryatWords,
            'russianWords' => $russianWords,
            'names' => $names,
        ]);
    }
}
