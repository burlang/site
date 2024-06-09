<?php

it('tests buryat words search', function ($url) {
    $response = httpClient()->request('GET', $url);
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toBeJson();
    expect($response->toArray())
        ->each(fn ($word) => expect($word)->toHaveKeys(['value']));
})->with([
    '/v1/buryat-word/search?q=а',
    '/api/v1/buryat-word/search?q=а',
]);

it('tests buryat word translate', function ($url) {
    $response = httpClient()->request('GET', $url);
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toBeJson();
    $data = $response->toArray();
    expect($data)
        ->toHaveKey('translations');
    expect($data['translations'])
        ->each(fn ($translation) => expect($translation)->toHaveKeys(['value']));
})->with([
    '/v1/buryat-word/translate?q=аабаганаха',
    '/api/v1/buryat-word/translate?q=аабаганаха',
]);

it('tests buryat word translate for non-existent word', function ($url) {
    $response = httpClient()->request('GET', $url);
    expect($response->getStatusCode())->toBe(404);
})->with([
    '/v1/buryat-word/translate?q=non-existent-word',
    '/api/v1/buryat-word/translate?q=non-existent-word',
]);
