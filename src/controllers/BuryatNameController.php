<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\BuryatName;
use yii\caching\CacheInterface;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BuryatNameController extends Controller
{
    public function behaviors(): array
    {
        return [
            [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'index',
                            'letter',
                            'view',
                            'list',
                        ],
                        'verbs' => ['GET'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(CacheInterface $cache): string
    {
        $letters = $cache->getOrSet('first-letters', static function () {
            return ArrayHelper::map(
                BuryatName::find()
                    ->select(['letter' => 'LEFT(name, 1)', 'amount' => 'COUNT(id)'])
                    ->groupBy('letter')
                    ->orderBy('letter')
                    ->asArray()
                    ->all(),
                'letter',
                'amount'
            );
        }, 5 * 60);

        return $this->render('index', [
            'letters' => $letters,
        ]);
    }

    public function actionList(?string $letter = null): string
    {
        $namesQuery = BuryatName::find()
            ->select('name');
        if ($letter) {
            $namesQuery->where(['LEFT(name, 1)' => $letter]);
        }

        $names = $namesQuery->column();
        $nameGroups = array_chunk($names, max(1, (int)ceil(\count($names) / 4)));

        return $this->renderPartial('partials/list', [
            'nameGroups' => $nameGroups,
        ]);
    }

    public function actionLetter(string $letter): string
    {
        return $this->render('letter', [
            'letter' => trim($letter),
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionView(string $name): string
    {
        $model = BuryatName::findOne(['name' => $name]);
        if (!$model) {
            throw new NotFoundHttpException('Имя не найдено');
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
