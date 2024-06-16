<?php

declare(strict_types=1);

it('tests russian words search', function ($url) {
    $response = httpClient()->request('GET', $url);
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toBeJson();
    expect($response->toArray())
        ->toBeArray()
        ->each(fn ($word) => expect($word)->toHaveKeys(['value']));
})->with([
    '/v1/russian-word/search?q=а',
    '/api/v1/russian-word/search?q=а',
]);

it('tests russian word translate', function ($url) {
    $response = httpClient()->request('GET', $url);
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toBeJson();
    $data = $response->toArray();
    expect($data)
        ->toBeArray()
        ->toHaveKey('translations');
    expect($data['translations'])
        ->toBeArray()
        ->each(fn ($translation) => expect($translation)->toHaveKeys(['value']));
})->with([
    '/v1/russian-word/translate?q=аббревиатура',
    '/api/v1/russian-word/translate?q=аббревиатура',
]);

it('tests russian word translate for non-existent word', function ($url) {
    $response = httpClient()->request('GET', $url);
    expect($response->getStatusCode())->toBe(404);
})->with([
    '/v1/russian-word/translate?q=non-existent-word',
    '/api/v1/russian-word/translate?q=non-existent-word',
]);
