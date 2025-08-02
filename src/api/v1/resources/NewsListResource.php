<?php

declare(strict_types=1);

namespace app\api\v1\resources;

use app\models\News;
use DateTimeImmutable;

class NewsListResource implements ResourceInterface
{
    /**
     * @var array<News>
     */
    private array $news;

    /**
     * @param array<News> $news
     */
    public function __construct(array $news)
    {
        $this->news = $news;
    }

    public function toArray(): array
    {
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
            $this->news
        );
    }
}
