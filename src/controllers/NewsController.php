<?php

namespace app\controllers;

use app\models\News;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class NewsController extends Controller
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
                        'roles' => ['news_management'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $query = News::find()->orderBy('created_at DESC');
        if (!Yii::$app->user->can('news_management')) {
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
     * @param string $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(string $slug): string
    {
        $news = News::findOne(['slug' => $slug]);
        if (!$news || (!$news->active && !Yii::$app->user->can('news_management'))) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
        return $this->render('view', [
            'model' => $news,
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $news = new News();
        if ($news->load(Yii::$app->request->post()) && $news->save()) {
            return $this->redirect(['view', 'slug' => $news->slug]);
        }
        return $this->render('create', [
            'model' => $news,
        ]);
    }

    /**
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $news = $this->getNews($id);
        if ($news->load(Yii::$app->request->post()) && $news->save()) {
            return $this->redirect(['view', 'slug' => $news->slug]);
        }
        return $this->render('update', [
            'model' => $news,
        ]);
    }

    /**
     * @param int $id
     * @return Response
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
     * @param int $id
     * @return News
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
