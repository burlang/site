<?php

declare(strict_types=1);

namespace app\api\v1\controllers;

use app\api\v1\components\Controller;
use app\api\v1\resources\BuryatNameListResource;
use app\api\v1\resources\BuryatNameResource;
use app\models\BuryatName;
use OpenApi\Attributes as OA;
use yii\web\NotFoundHttpException;

class BuryatNameController extends Controller
{
    #[OA\Get(
        path: '/api/v1/buryat-name/index',
        summary: 'Список всех бурятских имён',
        tags: ['Имена'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Список имён',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/BuryatNameListItem'),
                ),
            ),
        ],
    )]
    public function actionIndex(): BuryatNameListResource
    {
        $names = BuryatName::find()
            ->select('name')
            ->orderBy('name')
            ->asArray()
            ->column();

        return new BuryatNameListResource($names);
    }

    #[OA\Get(
        path: '/api/v1/buryat-name/search',
        summary: 'Поиск бурятских имён по префиксу',
        tags: ['Имена'],
        parameters: [
            new OA\Parameter(name: 'q', in: 'query', required: true, schema: new OA\Schema(type: 'string'), example: 'Аю'),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Список совпадающих имён (до 10)',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/BuryatNameListItem'),
                ),
            ),
        ],
    )]
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

    #[OA\Get(
        path: '/api/v1/buryat-name/get-name',
        summary: 'Получить информацию об имени',
        tags: ['Имена'],
        parameters: [
            new OA\Parameter(name: 'q', in: 'query', required: true, schema: new OA\Schema(type: 'string'), example: 'Аюша'),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Данные об имени',
                content: new OA\JsonContent(ref: '#/components/schemas/BuryatName'),
            ),
            new OA\Response(response: 404, description: 'Имя не найдено'),
        ],
    )]
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
