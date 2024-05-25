<?php

declare(strict_types=1);

namespace app\modules\api\v1\controllers;

use app\models\News;
use app\modules\api\v1\components\Controller;
use yii\web\NotFoundHttpException;

final class NewsController extends Controller
{
    public function actionIndex(int $page = 1): array
    {
        $pageLimit = 5;
        $news = News::find()
            ->active()
            ->offset(($page - 1) * $pageLimit)
            ->limit($pageLimit)
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return array_map(
            static function (News $news): array {
                return [
                    'title' => $news->title,
                    'slug' => $news->slug,
                    'description' => $news->description,
                    'created_date' => (new \DateTimeImmutable())
                        ->setTimestamp($news->created_at)
                        ->format('Y-m-d'),
                ];
            },
            $news
        );
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionGetNews(string $q): array
    {
        $news = News::find()
            ->where(['slug' => trim($q)])
            ->active()
            ->one();

        if ($news === null) {
            throw new NotFoundHttpException('Новость не найдена');
        }

        return [
            'name' => $news->title,
            'content' => $news->content,
            'created_date' => (new \DateTimeImmutable())
                ->setTimestamp($news->created_at)
                ->format('Y-m-d'),
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function verbs(): array
    {
        return [
            'index' => ['GET'],
            'get-news' => ['GET'],
        ];
    }
}
