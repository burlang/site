<?php

declare(strict_types=1);

namespace app\api\v1\resources;

use app\models\BuryatName;

class BuryatNameResource implements ResourceInterface
{
    private BuryatName $model;

    public function __construct(BuryatName $model)
    {
        $this->model = $model;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->model->name,
            'description' => $this->model->description,
            'note' => $this->model->note,
            'male' => $this->model->male,
            'female' => $this->model->female,
        ];
    }
}
