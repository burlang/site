<?php

declare(strict_types=1);

use app\components\Translator\YandexTranslator;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

it('translates to buryat on success', function (): void {
    $mock = new MockHttpClient([
        new MockResponse((string)json_encode([
            'translations' => [['text' => 'Сайн байна']],
        ])),
    ]);

    $result = (new YandexTranslator($mock, 'test-key'))->translateToBuryat('Привет');

    expect($result->text)->toBe('Сайн байна');
    expect($result->error)->toBeNull();
});

it('translates to russian on success', function (): void {
    $mock = new MockHttpClient([
        new MockResponse((string)json_encode([
            'translations' => [['text' => 'Привет']],
        ])),
    ]);

    $result = (new YandexTranslator($mock, 'test-key'))->translateToRussian('Сайн байна');

    expect($result->text)->toBe('Привет');
    expect($result->error)->toBeNull();
});

it('returns error when api key is empty', function (): void {
    $result = (new YandexTranslator(new MockHttpClient(), ''))->translateToBuryat('Привет');

    expect($result->text)->toBeNull();
    expect($result->error)->toBe('API ключ не настроен');
});

it('returns api error message on failed response', function (): void {
    $mock = new MockHttpClient([
        new MockResponse((string)json_encode([
            'message' => 'API key is invalid',
        ])),
    ]);

    $result = (new YandexTranslator($mock, 'bad-key'))->translateToBuryat('Привет');

    expect($result->text)->toBeNull();
    expect($result->error)->toBe('API key is invalid');
});

it('returns network error on transport exception', function (): void {
    $mock = new MockHttpClient(function (): never {
        throw new TransportException('Connection refused');
    });

    $result = (new YandexTranslator($mock, 'test-key'))->translateToBuryat('Привет');

    expect($result->text)->toBeNull();
    expect($result->error)->toBe('Ошибка сети');
});
