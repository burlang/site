<?php

declare(strict_types=1);

namespace app\api\v1\controllers;

use app\api\v1\components\Controller;
use app\api\v1\resources\BuryatWordListResource;
use app\api\v1\resources\BuryatWordTranslationsResource;
use app\models\BuryatWord;
use OpenApi\Attributes as OA;
use yii\web\NotFoundHttpException;

class BuryatWordController extends Controller
{
    #[OA\Get(
        path: '/api/v1/buryat-word/search',
        summary: 'Поиск бурятских слов по префиксу',
        tags: ['Бурятские слова'],
        parameters: [
            new OA\Parameter(name: 'q', in: 'query', required: true, schema: new OA\Schema(type: 'string'), example: 'нох'),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Список совпадающих слов (до 10)',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/BuryatWordListItem'),
                ),
            ),
        ],
    )]
    public function actionSearch(string $q): BuryatWordListResource
    {
        $q = trim($q);
        if ($q === '') {
            return new BuryatWordListResource([]);
        }
        $words = BuryatWord::find()
            ->select('name')
            ->filterWhere(['like', 'name', "{$q}%", false])
            ->orderBy('name')
            ->limit(10)
            ->asArray()
            ->column();

        return new BuryatWordListResource($words);
    }

    #[OA\Get(
        path: '/api/v1/buryat-word/translate',
        summary: 'Получить переводы бурятского слова на русский',
        tags: ['Бурятские слова'],
        parameters: [
            new OA\Parameter(name: 'q', in: 'query', required: true, schema: new OA\Schema(type: 'string'), example: 'нохой'),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Переводы слова',
                content: new OA\JsonContent(ref: '#/components/schemas/BuryatWordTranslations'),
            ),
            new OA\Response(response: 404, description: 'Слово не найдено'),
        ],
    )]
    public function actionTranslate(string $q): BuryatWordTranslationsResource
    {
        $q = trim($q);
        $word = BuryatWord::findOne(['name' => $q]);
        if (!$word) {
            throw new NotFoundHttpException('Слово не найдено');
        }

        return new BuryatWordTranslationsResource($word->translations);
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
