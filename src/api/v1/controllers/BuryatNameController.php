<?php

declare(strict_types=1);

namespace app\api\v1\controllers;

use app\api\v1\components\Controller;
use app\api\v1\resources\BuryatNameListResource;
use app\api\v1\resources\BuryatNameResource;
use app\models\BuryatName;
use yii\web\NotFoundHttpException;

class BuryatNameController extends Controller
{
    public function actionIndex(): BuryatNameListResource
    {
        $names = BuryatName::find()
            ->select('name')
            ->orderBy('name')
            ->asArray()
            ->column();

        return new BuryatNameListResource($names);
    }

    public function actionSearch(string $q): BuryatNameListResource
    {
        $q = trim($q);
        if ($q === '') {
            return new BuryatNameListResource([]);
        }
        $names = BuryatName::find()
            ->select('name')
            ->filterWhere(['like', 'name', "{$q}%", false])
            ->orderBy('name')
            ->limit(10)
            ->asArray()
            ->column();

        return new BuryatNameListResource($names);
    }

    public function actionGetName(string $q): BuryatNameResource
    {
        $q = trim($q);
        $name = $this->getBuryatName($q);

        return new BuryatNameResource($name);
    }

    /**
     * @return array<string, array<int, string>>
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
