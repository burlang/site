<?php

declare(strict_types=1);

namespace app\components\Translator;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GoogleTranslate
{
    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly string $apiKey,
    ) {}

    public function translateToBuryat(string $text): TranslationResult
    {
        return $this->translate($text, 'ru', 'bxr');
    }

    public function translateToRussian(string $text): TranslationResult
    {
        return $this->translate($text, 'bxr', 'ru');
    }

    private function translate(string $text, string $source, string $target): TranslationResult
    {
        if ($this->apiKey === '') {
            return TranslationResult::error('API ключ не настроен');
        }

        try {
            $response = $this->client->request('POST', 'https://translation.googleapis.com/language/translate/v2', [
                'query' => ['key' => $this->apiKey],
                'json' => ['q' => $text, 'source' => $source, 'target' => $target, 'format' => 'text'],
            ]);

            $data = $response->toArray(false);
            $translated = $data['data']['translations'][0]['translatedText'] ?? null;

            if ($translated === null) {
                return TranslationResult::error($data['error']['message'] ?? 'Неизвестная ошибка');
            }

            return TranslationResult::success($translated);
        } catch (TransportExceptionInterface $e) {
            return TranslationResult::error('Ошибка сети');
        }
    }
}
