<?php

namespace app\controllers\admin;

use app\components\DeviceDetector\DeviceDetectorInterface;
use app\models\BuryatName;
use app\models\search\BuryatNameSearch;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BuryatNameController extends Controller
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
                            'create',
                            'update',
                            'delete',
                        ],
                        'roles' => ['buryat_names_management'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(DeviceDetectorInterface $deviceDetector): string
    {
        $searchModel = new BuryatNameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'deviceDetector' => $deviceDetector,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->getName($id),
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $buryatName = new BuryatName();
        if ($buryatName->load(Yii::$app->request->post()) && $buryatName->save()) {
            return $this->redirect(['view', 'id' => $buryatName->id]);
        }
        return $this->render('create', [
            'model' => $buryatName,
        ]);
    }

    /**
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $buryatName = $this->getName($id);
        if ($buryatName->load(Yii::$app->request->post()) && $buryatName->save()) {
            return $this->redirect(['view', 'id' => $buryatName->id]);
        }
        return $this->render('update', [
            'model' => $buryatName,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     * @throws Exception
     */
    public function actionDelete(int $id): Response
    {
        $name = $this->getName($id);
        if (!$name->delete()) {
            throw new Exception('Не удалось удалить Имя');
        }
        Yii::$app->session->setFlash('success', 'Имя удалено');
        return $this->redirect(['index']);
    }

    /**
     * @throws NotFoundHttpException
     */
    private function getName(int $id): BuryatName
    {
        $name = BuryatName::findOne($id);
        if (!$name) {
            throw new NotFoundHttpException('Имя не найдено');
        }
        return $name;
    }
}
