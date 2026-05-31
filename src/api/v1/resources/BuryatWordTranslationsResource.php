<?php

declare(strict_types=1);

namespace app\api\v1\resources;

use app\models\BuryatTranslation;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'BuryatWordTranslations',
    properties: [
        new OA\Property(
            property: 'translations',
            type: 'array',
            items: new OA\Items(
                properties: [new OA\Property(property: 'value', type: 'string', example: 'собака')],
                type: 'object',
            ),
        ),
    ],
    type: 'object',
)]
class BuryatWordTranslationsResource implements ResourceInterface
{
    /**
     * @var array<BuryatTranslation>
     */
    private array $translations;

    /**
     * @param array<BuryatTranslation> $translations
     */
    public function __construct(array $translations)
    {
        $this->translations = $translations;
    }

    public function toArray(): array
    {
        return [
            'translations' => array_map(
                fn (BuryatTranslation $translation) => [
                    'value' => $translation->name,
                ],
                $this->translations
            ),
        ];
    }
}
