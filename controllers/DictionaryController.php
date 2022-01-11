<?php

namespace app\controllers;

use app\models\Dictionary;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class DictionaryController extends Controller
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
                        'actions' => ['index', 'view', 'update', 'create'],
                        'roles' => ['moderator'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Dictionary::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->getDictionary($id),
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $dictionary = new Dictionary();

        if ($dictionary->load(Yii::$app->request->post()) && $dictionary->save()) {
            return $this->redirect(['view', 'id' => $dictionary->id]);
        }
        return $this->render('create', [
            'model' => $dictionary,
        ]);
    }

    /**
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $dictionary = $this->getDictionary($id);

        if ($dictionary->load(Yii::$app->request->post()) && $dictionary->save()) {
            return $this->redirect(['view', 'id' => $dictionary->id]);
        }
        return $this->render('update', [
            'model' => $dictionary,
        ]);
    }

    /**
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException
     */
    public function actionDelete(int $id): Response
    {
        $dictionary = $this->getDictionary($id);
        if (!$dictionary->delete()) {
            throw new Exception('Не удалось удалить Словарь');
        }
        return $this->redirect(['index']);
    }

    /**
     * @param int $id
     * @return Dictionary
     * @throws NotFoundHttpException
     */
    private function getDictionary(int $id): Dictionary
    {
        $dictionary = Dictionary::findOne($id);
        if (!$dictionary) {
            throw new NotFoundHttpException('Запрашиваемая страница не существует');
        }
        return $dictionary;
    }
}
