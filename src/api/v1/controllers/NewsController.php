<?php

declare(strict_types=1);

namespace app\api\v1\controllers;

use app\api\v1\components\Controller;
use app\api\v1\resources\NewsListResource;
use app\api\v1\resources\NewsResource;
use app\models\News;
use OpenApi\Attributes as OA;
use yii\web\NotFoundHttpException;

final class NewsController extends Controller
{
    #[OA\Get(
        path: '/api/v1/news/index',
        summary: 'Список новостей',
        tags: ['Новости'],
        parameters: [
            new OA\Parameter(name: 'page', in: 'query', required: false, schema: new OA\Schema(type: 'integer', default: 1), example: 1),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Страница новостей (по 5 на страницу)',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/NewsListItem'),
                ),
            ),
        ],
    )]
    public function actionIndex(int $page = 1): NewsListResource
    {
        $pageLimit = 5;
        /** @var News[] $news */
        $news = News::find()
            ->active()
            ->offset(($page - 1) * $pageLimit)
            ->limit($pageLimit)
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return new NewsListResource($news);
    }

    #[OA\Get(
        path: '/api/v1/news/get-news',
        summary: 'Получить новость по slug',
        tags: ['Новости'],
        parameters: [
            new OA\Parameter(name: 'q', in: 'query', required: true, schema: new OA\Schema(type: 'string'), example: 'otkrytie-vystavki'),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Данные новости',
                content: new OA\JsonContent(ref: '#/components/schemas/News'),
            ),
            new OA\Response(response: 404, description: 'Новость не найдена'),
        ],
    )]
    public function actionGetNews(string $q): NewsResource
    {
        $q = trim($q);
        /** @var News|null $news */
        $news = News::find()
            ->active()
            ->where(['slug' => trim($q)])
            ->one();

        if (!$news) {
            throw new NotFoundHttpException('Новость не найдена');
        }

        return new NewsResource($news);
    }

    /**
     * @return array<string, array<int, string>>
     */
    protected function verbs(): array
    {
        return [
            'index' => ['GET'],
            'get-news' => ['GET'],
        ];
    }
}
