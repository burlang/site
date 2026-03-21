<?php

declare(strict_types=1);

namespace app\components;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class GoogleTranslate
{
    public function __construct(private readonly string $apiKey) {}

    /**
     * @return array{text: string|null, error: string|null}
     */
    public function translate(string $text, string $source, string $target): array
    {
        if ($this->apiKey === '') {
            return ['text' => null, 'error' => 'API ключ не настроен'];
        }

        try {
            $client = HttpClient::create(['timeout' => 10]);
            $response = $client->request('POST', 'https://translation.googleapis.com/language/translate/v2', [
                'query' => ['key' => $this->apiKey],
                'json' => ['q' => $text, 'source' => $source, 'target' => $target, 'format' => 'text'],
            ]);

            $data = $response->toArray(false);
            $translated = $data['data']['translations'][0]['translatedText'] ?? null;

            if ($translated === null) {
                return ['text' => null, 'error' => $data['error']['message'] ?? 'Неизвестная ошибка'];
            }

            return ['text' => $translated, 'error' => null];
        } catch (TransportExceptionInterface $e) {
            return ['text' => null, 'error' => 'Ошибка сети'];
        }
    }
}
