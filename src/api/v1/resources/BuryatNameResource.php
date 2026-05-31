<?php

declare(strict_types=1);

namespace app\api\v1\resources;

use app\models\BuryatName;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'BuryatName',
    properties: [
        new OA\Property(property: 'name', type: 'string', example: 'Аюша'),
        new OA\Property(property: 'description', type: 'string', nullable: true, example: 'Имеет значение «долголетний»'),
        new OA\Property(property: 'note', type: 'string', nullable: true, example: 'Употребляется как мужское имя'),
        new OA\Property(property: 'male', type: 'boolean', example: true),
        new OA\Property(property: 'female', type: 'boolean', example: false),
    ],
    type: 'object',
)]
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
