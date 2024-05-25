<?php

declare(strict_types=1);

namespace app\api\v1\controllers;

use app\api\v1\components\Controller;
use app\models\BuryatName;
use yii\web\NotFoundHttpException;

class BuryatNameController extends Controller
{
    public function actionIndex(): array
    {
        return BuryatName::find()
            ->select(['value' => 'name'])
            ->asArray()
            ->all();
    }

    public function actionSearch(string $q): array
    {
        return BuryatName::find()
            ->select(['value' => 'name'])
            ->filterWhere(['like', 'name', $q . '%', false])
            ->orderBy('name')
            ->limit(10)
            ->asArray()
            ->all();
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionGetName(string $q): array
    {
        $name = $this->getBuryatName($q);
        return [
            'name' => $name->name,
            'description' => $name->description,
            'note' => $name->note,
            'male' => $name->male,
            'female' => $name->female,
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function verbs(): array
    {
        return [
            'search' => ['GET'],
            'get-name' => ['GET'],
            'index' => ['GET'],
        ];
    }

    /**
     * @throws NotFoundHttpException
     */
    private function getBuryatName(string $name): BuryatName
    {
        $name = BuryatName::findOne(['name' => $name]);
        if (!$name) {
            throw new NotFoundHttpException('Имя не найдено');
        }
        return $name;
    }
}
