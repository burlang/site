<?php

declare(strict_types=1);

namespace app\controllers;

use app\components\DeviceDetector\DeviceDetectorInterface;
use app\enums\PermissionEnum;
use app\models\Dictionary;
use app\models\RussianTranslation;
use app\models\RussianWord;
use app\models\search\RussianWordSearch;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\Session;

class RussianWordController extends Controller
{
    public function behaviors(): array
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
                        'roles' => [PermissionEnum::RUSSIAN_WORDS_MANAGEMENT->value],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(DeviceDetectorInterface $deviceDetector): string
    {
        $searchModel = new RussianWordSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'deviceDetector' => $deviceDetector,
        ]);
    }

    public function actionCreate(Session $session): Response|string
    {
        $word = new RussianWord();
        $dictionaries = ArrayHelper::map(
            Dictionary::find()->asArray()->all(),
            'id',
            'name'
        );
        if ($word->load((array)$this->request->post()) && $word->save()) {
            $session->setFlash('success', 'Слово добавлено');
            return $this->redirect(['update', 'id' => $word->id]);
        }
        return $this->render('create', [
            'model' => $word,
            'dictionaries' => $dictionaries,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionUpdate(
        DeviceDetectorInterface $deviceDetector,
        Session $session,
        int $id
    ): Response|string {
        $word = $this->getWord($id);
        $dictionaries = ArrayHelper::map(
            Dictionary::find()->asArray()->all(),
            'id',
            'name'
        );
        $translationForm = new RussianTranslation();
        $translationForm->ruword_id = $word->id;
        if ($translationForm->load((array)$this->request->post()) && $translationForm->save()) {
            $session->setFlash('success', 'Перевод добавлен');
            return $this->refresh();
        }
        if ($word->load((array)$this->request->post()) && $word->save()) {
            $session->setFlash('success', 'Данные обновлены');
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
    public function actionDelete(Session $session, int $id): Response
    {
        $word = $this->getWord($id);
        if (!$word->delete()) {
            throw new Exception('Не удалось удалить Слово');
        }
        $session->setFlash('success', 'Слово удалено');
        return $this->redirect(['index']);
    }

    /**
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function actionDeleteTranslation(Session $session, int $id): Response
    {
        $translation = $this->getTranslation($id);
        if (!$translation->delete()) {
            throw new Exception('Не удалось удалить перевод');
        }
        $session->setFlash('success', 'Перевод удален');
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
