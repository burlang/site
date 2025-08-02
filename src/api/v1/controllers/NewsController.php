<?php

declare(strict_types=1);

namespace app\api\v1\controllers;

use app\api\v1\components\Controller;
use app\api\v1\resources\NewsListResource;
use app\api\v1\resources\NewsResource;
use app\models\News;
use yii\web\NotFoundHttpException;

final class NewsController extends Controller
{
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

    /**
     * @throws NotFoundHttpException
     */
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
