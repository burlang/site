<?php

declare(strict_types=1);

namespace app\components\Translator;

final readonly class TranslationResult
{
    private function __construct(
        public readonly ?string $text,
        public readonly ?string $error,
    ) {}

    public static function success(string $text): self
    {
        return new self($text, null);
    }

    public static function error(string $message): self
    {
        return new self(null, $message);
    }
}
