<?php

namespace app\controllers;

use app\models\Page;
use app\models\search\PageSearch;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class PageController extends Controller
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
                'except' => ['view'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['?', '@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'index',
                            'create',
                            'update',
                            'delete',
                        ],
                        'roles' => ['pages_management'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param string $link
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(string $link): string
    {
        $page = Page::findOne(['link' => $link]);
        if (!$page || (!$page->active && !Yii::$app->user->can('pages_management'))) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
        return $this->render('view', [
            'model' => $page,
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $page = new Page();
        if ($page->load(Yii::$app->request->post()) && $page->save()) {
            return $this->redirect(['view', 'link' => $page->link]);
        }
        return $this->render('create', [
            'model' => $page,
        ]);
    }

    /**
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $page = $this->getPage($id);
        if ($page->load(Yii::$app->request->post()) && $page->save()) {
            return $this->redirect(['view', 'link' => $page->link]);
        }
        return $this->render('update', [
            'model' => $page,
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
        $model = $this->getPage($id);
        if (!$model->static) {
            if (!$model->delete()) {
                throw new Exception('Не удалось удалить Страницу');
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * @param int $id
     * @return Page
     * @throws NotFoundHttpException
     */
    private function getPage(int $id): Page
    {
        $page = Page::findOne($id);
        if (!$page) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
        return $page;
    }
}
