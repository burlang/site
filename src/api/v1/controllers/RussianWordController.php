<?php

declare(strict_types=1);

namespace app\api\v1\controllers;

use app\api\v1\components\Controller;
use app\api\v1\resources\RussianWordListResource;
use app\api\v1\resources\RussianWordTranslationsResource;
use app\models\RussianWord;
use OpenApi\Attributes as OA;
use yii\web\NotFoundHttpException;

class RussianWordController extends Controller
{
    #[OA\Get(
        path: '/api/v1/russian-word/search',
        summary: 'Поиск русских слов по префиксу',
        tags: ['Русские слова'],
        parameters: [
            new OA\Parameter(name: 'q', in: 'query', required: true, schema: new OA\Schema(type: 'string'), example: 'соб'),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Список совпадающих слов (до 10)',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/RussianWordListItem'),
                ),
            ),
        ],
    )]
    public function actionSearch(string $q): RussianWordListResource
    {
        $q = trim($q);
        if ($q === '') {
            return new RussianWordListResource([]);
        }
        $words = RussianWord::find()
            ->select('name')
            ->filterWhere(['like', 'name', "{$q}%", false])
            ->orderBy('name')
            ->limit(10)
            ->asArray()
            ->column();

        return new RussianWordListResource($words);
    }

    #[OA\Get(
        path: '/api/v1/russian-word/translate',
        summary: 'Получить переводы русского слова на бурятский',
        tags: ['Русские слова'],
        parameters: [
            new OA\Parameter(name: 'q', in: 'query', required: true, schema: new OA\Schema(type: 'string'), example: 'собака'),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Переводы слова',
                content: new OA\JsonContent(ref: '#/components/schemas/RussianWordTranslations'),
            ),
            new OA\Response(response: 404, description: 'Слово не найдено'),
        ],
    )]
    public function actionTranslate(string $q): RussianWordTranslationsResource
    {
        $q = trim($q);
        $word = RussianWord::findOne(['name' => $q]);
        if (!$word) {
            throw new NotFoundHttpException('Слово не найдено');
        }

        return new RussianWordTranslationsResource($word->translations);
    }

    /**
     * @return array<string, array<int, string>>
     */
    protected function verbs(): array
    {
        return [
            'search' => ['GET'],
            'translate' => ['GET'],
        ];
    }
}
