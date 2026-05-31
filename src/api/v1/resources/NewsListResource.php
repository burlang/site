<?php

declare(strict_types=1);

namespace app\api\v1\resources;

use app\models\News;
use DateTimeImmutable;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'NewsListItem',
    properties: [
        new OA\Property(property: 'title', type: 'string', example: 'Открытие выставки'),
        new OA\Property(property: 'slug', type: 'string', example: 'otkrytie-vystavki'),
        new OA\Property(property: 'description', type: 'string', nullable: true, example: 'Краткое описание события'),
        new OA\Property(property: 'created_date', type: 'string', format: 'date', example: '2024-03-15'),
    ],
    type: 'object',
)]
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
