<?php

declare(strict_types=1);

namespace app\api\v1\controllers;

use app\api\v1\components\Controller;
use app\models\News;
use DateTimeImmutable;
use yii\web\NotFoundHttpException;

final class NewsController extends Controller
{
    /**
     * @return array<int, array<string, string>>
     */
    public function actionIndex(int $page = 1): array
    {
        $pageLimit = 5;
        /** @var News[] $news */
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
                    'created_date' => (new DateTimeImmutable())
                        ->setTimestamp($news->created_at)
                        ->format('Y-m-d'),
                ];
            },
            $news
        );
    }

    /**
     * @return array<string, string>
     * @throws NotFoundHttpException
     */
    public function actionGetNews(string $q): array
    {
        /** @var News|null $news */
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
            'created_date' => (new DateTimeImmutable())
                ->setTimestamp($news->created_at)
                ->format('Y-m-d'),
        ];
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
