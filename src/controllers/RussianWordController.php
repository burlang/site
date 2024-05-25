<?php

declare(strict_types=1);

namespace app\controllers;

use app\components\DeviceDetector\DeviceDetectorInterface;
use app\models\Dictionary;
use app\models\RussianTranslation;
use app\models\RussianWord;
use app\models\search\RussianWordSearch;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class RussianWordController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
                    'create' => ['GET', 'POST'],
                    'update' => ['GET', 'POST'],
                    'delete' => ['POST'],
                    'delete-translation' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'index',
                            'create',
                            'update',
                            'delete',
                            'delete-translation',
                        ],
                        'roles' => ['russian_words_management'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(DeviceDetectorInterface $deviceDetector): string
    {
        $searchModel = new RussianWordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'deviceDetector' => $deviceDetector,
        ]);
    }

    /**
     * @return Response|string
     */
    public function actionCreate()
    {
        $word = new RussianWord();
        $dictionaries = ArrayHelper::map(
            Dictionary::find()->asArray()->all(),
            'id',
            'name'
        );
        if ($word->load(Yii::$app->request->post()) && $word->save()) {
            Yii::$app->session->setFlash('success', 'Слово добавлено');
            return $this->redirect(['update', 'id' => $word->id]);
        }
        return $this->render('create', [
            'model' => $word,
            'dictionaries' => $dictionaries,
        ]);
    }

    /**
     * @return Response|string
     * @throws NotFoundHttpException
     */
    public function actionUpdate(DeviceDetectorInterface $deviceDetector, int $id)
    {
        $word = $this->getWord($id);
        $dictionaries = ArrayHelper::map(
            Dictionary::find()->asArray()->all(),
            'id',
            'name'
        );
        $translationForm = new RussianTranslation();
        $translationForm->ruword_id = $word->id;
        if ($translationForm->load(Yii::$app->request->post()) && $translationForm->save()) {
            Yii::$app->session->setFlash('success', 'Перевод добавлен');
            return $this->refresh();
        }
        if ($word->load(Yii::$app->request->post()) && $word->save()) {
            Yii::$app->session->setFlash('success', 'Данные обновлены');
            return $this->refresh();
        }
        return $this->render('update', [
            'model' => $word,
            'translationForm' => $translationForm,
            'dictionaries' => $dictionaries,
            'deviceDetector' => $deviceDetector,
        ]);
    }

    /**
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function actionDelete(int $id): Response
    {
        $word = $this->getWord($id);
        if (!$word->delete()) {
            throw new Exception('Не удалось удалить Слово');
        }
        Yii::$app->session->setFlash('success', 'Слово удалено');
        return $this->redirect(['index']);
    }

    /**
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function actionDeleteTranslation(int $id): Response
    {
        $translation = $this->getTranslation($id);
        if (!$translation->delete()) {
            throw new Exception('Не удалось удалить перевод');
        }
        Yii::$app->session->setFlash('success', 'Перевод удален');
        return $this->redirect(['update', 'id' => $translation->ruword_id]);
    }

    /**
     * @throws NotFoundHttpException
     */
    private function getWord(int $id): RussianWord
    {
        $word = RussianWord::findOne($id);
        if (!$word) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
        return $word;
    }

    private function getTranslation(int $id): RussianTranslation
    {
        $translation = RussianTranslation::findOne($id);
        if (!$translation) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
        return $translation;
    }
}
