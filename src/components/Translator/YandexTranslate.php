<?php

declare(strict_types=1);

namespace app\components\Translator;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class YandexTranslate
{
    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly string $apiKey,
    ) {}

    public function translateToBuryat(string $text): TranslationResult
    {
        return $this->translate($text, 'ru', 'bua');
    }

    public function translateToRussian(string $text): TranslationResult
    {
        return $this->translate($text, 'bua', 'ru');
    }

    private function translate(string $text, string $source, string $target): TranslationResult
    {
        if ($this->apiKey === '') {
            return TranslationResult::error('API ключ не настроен');
        }

        try {
            $response = $this->client->request('POST', 'https://translate.api.cloud.yandex.net/translate/v2/translate', [
                'headers' => ['Authorization' => "Api-Key {$this->apiKey}"],
                'json' => ['texts' => [$text], 'sourceLanguageCode' => $source, 'targetLanguageCode' => $target],
            ]);

            $data = $response->toArray(false);
            $translated = $data['translations'][0]['text'] ?? null;

            if ($translated === null) {
                return TranslationResult::error($data['message'] ?? 'Неизвестная ошибка');
            }

            return TranslationResult::success($translated);
        } catch (TransportExceptionInterface $e) {
            return TranslationResult::error('Ошибка сети');
        }
    }
}
