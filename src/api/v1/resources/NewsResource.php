<?php

declare(strict_types=1);

namespace app\api\v1\resources;

use app\models\News;
use DateTimeImmutable;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'News',
    properties: [
        new OA\Property(property: 'name', type: 'string', example: 'Открытие выставки'),
        new OA\Property(property: 'content', type: 'string', example: 'Подробное описание события...'),
        new OA\Property(property: 'created_date', type: 'string', format: 'date', example: '2024-03-15'),
    ],
    type: 'object',
)]
class NewsResource implements ResourceInterface
{
    private News $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->news->title,
            'content' => $this->news->content,
            'created_date' => (new DateTimeImmutable())
                ->setTimestamp($this->news->created_at)
                ->format('Y-m-d'),
        ];
    }
}
