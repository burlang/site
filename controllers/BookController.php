<?php

namespace app\controllers;

use app\components\DeviceDetect\DeviceDetectInterface;
use app\models\Book;
use app\models\BookChapter;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BookController extends Controller
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
                    'delete' => ['POST'],
                    'create' => ['GET', 'POST'],
                    'update' => ['GET', 'POST'],
                    'chapter-create' => ['GET', 'POST'],
                    'chapter-update' => ['GET', 'POST'],
                    'chapter' => ['GET'],
                    'chapter-delete' => ['DELETE'],
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
                            'chapter',
                        ],
                        'roles' => ['?', '@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'delete',
                            'create',
                            'update',
                            'chapter-create',
                            'chapter-update',
                            'chapter-delete',
                        ],
                        'roles' => ['adminBook'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(DeviceDetectInterface $deviceDetect): string
    {
        $query = Book::find()->orderBy('created_at DESC');
        if (!Yii::$app->user->can('adminBook')) {
            $query->where(['active' => 1]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 5],
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'deviceDetect' => $deviceDetect,
        ]);
    }

    /**
     * @param string $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(string $slug): string
    {
        $model = Book::findOne(['slug' => $slug]);
        if (!$model || (!$model->active && !Yii::$app->user->can('adminBook'))) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Book();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'slug' => $model->slug]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $book = $this->getBook($id);
        if ($book->load(Yii::$app->request->post()) && $book->save()) {
            return $this->redirect(['view', 'slug' => $book->slug]);
        }
        return $this->render('update', [
            'model' => $book,
        ]);
    }

    /**
     * @param int $id
     * @return Response
     * @throws Exception
     * @throws NotFoundHttpException
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id): Response
    {
        $book = $this->getBook($id);
        if (!$book->delete()) {
            throw new Exception('Не удлалось удалить книгу');
        }
        return $this->redirect(['index']);
    }

    /**
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionChapterCreate(int $id)
    {
        $book = $this->getBook($id);
        $chapter = new BookChapter(['book_id' => $id]);
        if ($chapter->load(Yii::$app->request->post()) && $chapter->save()) {
            return $this->redirect([
                'chapter',
                'slug' => $book->slug,
                'chapterSlug' => $chapter->slug,
            ]);
        }
        return $this->render('chapter/create', [
            'chapter' => $chapter,
            'book' => $book,
        ]);
    }

    /**
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionChapterUpdate(int $id)
    {
        $chapter = $this->getChapter($id);

        if ($chapter->load(Yii::$app->request->post()) && $chapter->save()) {
            return $this->redirect([
                'chapter',
                'slug' => $chapter->book->slug,
                'chapterSlug' => $chapter->slug,
            ]);
        }
        return $this->render('chapter/update', [
            'chapter' => $chapter,
        ]);
    }

    /**
     * @param string $slug
     * @param string $chapterSlug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionChapter(string $slug, string $chapterSlug): string
    {
        $chapter = BookChapter::find()
            ->joinWith('book')
            ->where(['and', ['book.slug' => $slug], ['book_chapter.slug' => $chapterSlug]])
            ->one();

        if (!$chapter || (!$chapter->book->active && !Yii::$app->user->can('adminBook'))) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
        return $this->render('chapter/view', [
            'chapter' => $chapter,
        ]);
    }

    /**
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionChapterDelete(int $id): Response
    {
        $chapter = $this->getChapter($id);
        if (!$chapter->delete()) {
            throw new Exception('Не удалось удалить главу');
        }

        return $this->redirect(['view', 'slug' => $chapter->book->slug]);
    }

    /**
     * @param int $id
     * @return Book
     * @throws NotFoundHttpException
     */
    private function getBook(int $id): Book
    {
        $book = Book::findOne($id);
        if (!$book) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
        return $book;
    }

    /**
     * @param int $id
     * @return BookChapter
     * @throws NotFoundHttpException
     */
    private function getChapter(int $id): BookChapter
    {
        $chapter = BookChapter::findOne($id);
        if (!$chapter) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
        return $chapter;
    }
}
