<?php

declare(strict_types=1);

namespace app\api\v1\resources;

interface ResourceInterface
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(): array;
}
