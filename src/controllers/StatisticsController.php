<?php

namespace app\controllers;

use app\models\BuryatName;
use app\models\BuryatTranslation;
use app\models\BuryatWord;
use app\models\RussianTranslation;
use app\models\RussianWord;
use app\models\SearchData;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class StatisticsController extends Controller
{
    /**
     * {@inheritDoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
                    'search' => ['GET'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'index',
                            'search',
                        ],
                        'roles' => ['statistics_view'],
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

    public function actionSearch(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SearchData::find()->orderBy('created_at DESC'),
        ]);

        return $this->render('search', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
