<?php

declare(strict_types=1);

namespace app\components\Translator;

final readonly class TranslationResult
{
    private function __construct(
        public readonly TranslationProvider $provider,
        public readonly ?string $text,
        public readonly ?string $error,
    ) {}

    public static function success(TranslationProvider $provider, string $text): self
    {
        return new self($provider, $text, null);
    }

    public static function error(TranslationProvider $provider, string $message): self
    {
        return new self($provider, null, $message);
    }
}
