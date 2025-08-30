<?php

declare(strict_types=1);

it('open home page', function (): void {
    $response = httpClient()->request('GET', '/');
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toContain('<h3>Новости</h3>');
    expect($response->getContent())->toContain('Словарь');
});

it('open buryat names page', function (): void {
    $response = httpClient()->request('GET', '/buryat-names');
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toContain('<h1>Бурятские имена</h1>');
});

it('open news page', function (): void {
    $response = httpClient()->request('GET', '/news');
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toContain('<h1 class="hidden-xs">Новости</h1>');
});

it('open contacts page', function (): void {
    $response = httpClient()->request('GET', '/contacts');
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toContain('<h1>Контакты</h1>');
});

it('open login page', function (): void {
    $response = httpClient()->request('GET', '/login');
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toContain('<h3 class="panel-title">Вход</h3>');
});
