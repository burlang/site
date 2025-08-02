<?php

declare(strict_types=1);

namespace app\api\v1\resources;

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
