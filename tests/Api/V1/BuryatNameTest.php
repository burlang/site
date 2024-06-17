<?php

declare(strict_types=1);

it('tests buryat names list', function (): void {
    $response = httpClient()->request('GET', '/api/v1/names');
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toBeJson();
    expect($response->toArray())
        ->each(fn ($name) => expect($name)->toHaveKeys(['value']));
});

it('tests buryat names search', function ($url): void {
    $response = httpClient()->request('GET', $url);
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toBeJson();
    expect($response->toArray())
        ->each(fn ($name) => expect($name)->toHaveKeys(['value']));
})->with([
    '/v1/names/search?q=а',
    '/api/v1/names/search?q=а',
]);

it('tests buryat name get', function ($url): void {
    $response = httpClient()->request('GET', $url);
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toBeJson();
    expect($response->toArray())
        ->toMatchArray([
            'name' => 'Абармид',
            'description' => 'запредельный',
        ]);
})->with([
    '/v1/names/get-name?q=Абармид',
    '/api/v1/names/get-name?q=Абармид',
]);

it('tests buryat name get for non-existent name', function ($url): void {
    $response = httpClient()->request('GET', $url);
    expect($response->getStatusCode())->toBe(404);
})->with([
    '/v1/names/get-name?q=non-existent-name',
    '/api/v1/names/get-name?q=non-existent-name',
]);
