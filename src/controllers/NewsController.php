<?php

declare(strict_types=1);

namespace app\controllers;

use app\enums\PermissionEnum;
use app\models\News;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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
                    'create' => ['GET', 'POST'],
                    'update' => ['GET', 'POST'],
                    'delete' => ['POST'],
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
                    [
                        'allow' => true,
                        'actions' => [
                            'create',
                            'update',
                            'delete',
                        ],
                        'roles' => [PermissionEnum::NEWS_MANAGEMENT->value],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $query = News::find()->orderBy('created_at DESC');
        if (!can(PermissionEnum::NEWS_MANAGEMENT->value)) {
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
        if (!$news || (!$news->active && !can(PermissionEnum::NEWS_MANAGEMENT->value))) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
        return $this->render('view', [
            'model' => $news,
        ]);
    }

    public function actionCreate(): Response|string
    {
        $news = new News();
        if ($news->load((array)$this->request->post()) && $news->save()) {
            return $this->redirect(['view', 'slug' => $news->slug]);
        }
        return $this->render('create', [
            'model' => $news,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id): Response|string
    {
        $news = $this->getNews($id);
        if ($news->load((array)$this->request->post()) && $news->save()) {
            return $this->redirect(['view', 'slug' => $news->slug]);
        }
        return $this->render('update', [
            'model' => $news,
        ]);
    }

    /**
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function actionDelete(int $id): Response
    {
        $news = $this->getNews($id);
        if (!$news->delete()) {
            throw new Exception('Не удалось удалить Новость');
        }
        return $this->redirect(['index']);
    }

    /**
     * @throws NotFoundHttpException
     */
    private function getNews(int $id): News
    {
        $news = News::findOne($id);
        if (!$news) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
        return $news;
    }
}
