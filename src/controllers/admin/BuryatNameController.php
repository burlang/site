<?php

declare(strict_types=1);

namespace app\controllers\admin;

use app\components\DeviceDetector\DeviceDetectorInterface;
use app\enums\PermissionEnum;
use app\models\BuryatName;
use app\models\search\BuryatNameSearch;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\Session;

class BuryatNameController extends Controller
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
                            'create',
                            'update',
                            'delete',
                        ],
                        'roles' => [PermissionEnum::BURYAT_NAMES_MANAGEMENT->value],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(DeviceDetectorInterface $deviceDetector): string
    {
        $searchModel = new BuryatNameSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
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

    public function actionCreate(): Response|string
    {
        $buryatName = new BuryatName();
        if ($buryatName->load($this->request->post()) && $buryatName->save()) {
            return $this->redirect(['view', 'id' => $buryatName->id]);
        }
        return $this->render('create', [
            'model' => $buryatName,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id): Response|string
    {
        $buryatName = $this->getName($id);
        if ($buryatName->load($this->request->post()) && $buryatName->save()) {
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
    public function actionDelete(Session $session, int $id): Response
    {
        $name = $this->getName($id);
        if (!$name->delete()) {
            throw new Exception('Не удалось удалить Имя');
        }
        $session->setFlash('success', 'Имя удалено');
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
