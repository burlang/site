<?php

declare(strict_types=1);

namespace app\api\v1\resources;

use app\models\RussianTranslation;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'RussianWordTranslations',
    properties: [
        new OA\Property(
            property: 'translations',
            type: 'array',
            items: new OA\Items(
                properties: [new OA\Property(property: 'value', type: 'string', example: 'нохой')],
                type: 'object',
            ),
        ),
    ],
    type: 'object',
)]
class RussianWordTranslationsResource implements ResourceInterface
{
    /**
     * @var array<RussianTranslation>
     */
    private array $translations;

    /**
     * @param array<RussianTranslation> $translations
     */
    public function __construct(array $translations)
    {
        $this->translations = $translations;
    }

    public function toArray(): array
    {
        return [
            'translations' => array_map(
                fn (RussianTranslation $translation) => [
                    'value' => $translation->name,
                ],
                $this->translations
            ),
        ];
    }
}
