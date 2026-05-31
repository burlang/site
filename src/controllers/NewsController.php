<?php

declare(strict_types=1);

namespace app\controllers;

use app\enums\PermissionEnum;
use app\models\News;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
{
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
                    'view' => ['GET'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'index',
                            'view',
                        ],
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $query = News::find()->orderBy('created_at DESC');
        if (!can(PermissionEnum::NewsManagement->value)) {
            $query->where(['active' => 1]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 5],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionView(string $slug): string
    {
        $news = News::findOne(['slug' => $slug]);
        if (!$news || (!$news->active && !can(PermissionEnum::NewsManagement->value))) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
        return $this->render('view', [
            'model' => $news,
        ]);
    }
}
