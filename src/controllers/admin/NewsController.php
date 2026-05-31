<?php

declare(strict_types=1);

namespace app\controllers\admin;

use app\enums\PermissionEnum;
use app\models\News;
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

    public function actionCreate(): Response|string
    {
        $news = new News();
        if ($news->load((array)$this->request->post()) && $news->save()) {
            return $this->redirect(['/news/view', 'slug' => $news->slug]);
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
            return $this->redirect(['/news/view', 'slug' => $news->slug]);
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
        return $this->redirect(['/news/index']);
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
