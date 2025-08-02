<?php

declare(strict_types=1);

namespace app\api\v1\resources;

use app\models\News;
use DateTimeImmutable;

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
