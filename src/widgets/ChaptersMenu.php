<?php

declare(strict_types=1);

namespace app\widgets;

use app\models\Book;
use yii\base\Widget;

class ChaptersMenu extends Widget
{
    public Book $book;
    public ?int $activeId = null;

    public function run(): string
    {
        return $this->render('@templates/widgets/chapters-menu', [
            'model' => $this->book,
            'activeId' => $this->activeId,
        ]);
    }
}
