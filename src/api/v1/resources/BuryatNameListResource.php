<?php

declare(strict_types=1);

namespace app\api\v1\resources;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'BuryatNameListItem',
    properties: [
        new OA\Property(property: 'value', type: 'string', example: 'Аюша'),
    ],
    type: 'object',
)]
class BuryatNameListResource implements ResourceInterface
{
    /**
     * @var array<string>
     */
    private array $names;

    /**
     * @param array<string> $names
     */
    public function __construct(array $names)
    {
        $this->names = $names;
    }

    public function toArray(): array
    {
        return array_map(
            fn (string $name) => [
                'value' => $name,
            ],
            $this->names
        );
    }
}
