<?php

declare(strict_types=1);

it('tests news list', function (): void {
    $response = httpClient()->request('GET', '/api/v1/news');
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toBeJson();
    expect($response->toArray())
        ->each(fn ($news) => $news->toHaveKeys(['title', 'slug', 'description', 'created_date']));
});

it('tests news get', function (): void {
    $response = httpClient()->request('GET', '/api/v1/news');
    $news = $response->toArray()[0];
    $response = httpClient()->request('GET', '/api/v1/news/get-news?q=' . $news['slug']);
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toBeJson();
    expect($response->toArray())
        ->toHaveKeys(['name', 'content', 'created_date']);
});

it('tests news get for non-existent news', function (): void {
    $response = httpClient()->request('GET', '/api/v1/news/get-news?q=non-existent-news');
    expect($response->getStatusCode())->toBe(404);
});
