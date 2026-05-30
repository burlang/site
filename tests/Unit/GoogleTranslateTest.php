<?php

declare(strict_types=1);

use app\components\Translator\GoogleTranslate;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

it('translates to buryat on success', function (): void {
    $mock = new MockHttpClient([
        new MockResponse((string)json_encode([
            'data' => ['translations' => [['translatedText' => 'Сайн байна']]],
        ])),
    ]);

    $result = (new GoogleTranslate($mock, 'test-key'))->translateToBuryat('Привет');

    expect($result->text)->toBe('Сайн байна');
    expect($result->error)->toBeNull();
});

it('translates to russian on success', function (): void {
    $mock = new MockHttpClient([
        new MockResponse((string)json_encode([
            'data' => ['translations' => [['translatedText' => 'Привет']]],
        ])),
    ]);

    $result = (new GoogleTranslate($mock, 'test-key'))->translateToRussian('Сайн байна');

    expect($result->text)->toBe('Привет');
    expect($result->error)->toBeNull();
});

it('returns error when api key is empty', function (): void {
    $result = (new GoogleTranslate(new MockHttpClient(), ''))->translateToBuryat('Привет');

    expect($result->text)->toBeNull();
    expect($result->error)->toBe('API ключ не настроен');
});

it('returns api error message on failed response', function (): void {
    $mock = new MockHttpClient([
        new MockResponse((string)json_encode([
            'error' => ['message' => 'API key not valid'],
        ])),
    ]);

    $result = (new GoogleTranslate($mock, 'bad-key'))->translateToBuryat('Привет');

    expect($result->text)->toBeNull();
    expect($result->error)->toBe('API key not valid');
});

it('returns network error on transport exception', function (): void {
    $mock = new MockHttpClient(function (): never {
        throw new TransportException('Connection refused');
    });

    $result = (new GoogleTranslate($mock, 'test-key'))->translateToBuryat('Привет');

    expect($result->text)->toBeNull();
    expect($result->error)->toBe('Ошибка сети');
});
