<?php

declare(strict_types=1);

namespace app\api\v1\resources;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'BuryatWordListItem',
    properties: [
        new OA\Property(property: 'value', type: 'string', example: 'нохой'),
    ],
    type: 'object',
)]
class BuryatWordListResource implements ResourceInterface
{
    /**
     * @var array<string>
     */
    private array $words;

    /**
     * @param array<string> $words
     */
    public function __construct(array $words)
    {
        $this->words = $words;
    }

    public function toArray(): array
    {
        return array_map(
            fn (string $word) => [
                'value' => $word,
            ],
            $this->words
        );
    }
}
