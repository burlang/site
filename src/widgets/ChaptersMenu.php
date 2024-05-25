<?php

namespace app\widgets;

use app\models\Book;
use yii\base\Widget;

class ChaptersMenu extends Widget
{
    public Book $book;
    public ?int $activeId = null;

    /**
     * {@inheritDoc}
     */
    public function run(): string
    {
        return $this->render('chapters-menu', [
            'model' => $this->book,
            'activeId' => $this->activeId,
        ]);
    }
}
