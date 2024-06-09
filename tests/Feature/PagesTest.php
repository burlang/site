<?php

test('open home page', function () {
    $response = httpClient()->request('GET', '/');
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toContain('<h3>Новости</h3>');
    expect($response->getContent())->toContain('Словарь');
});

test('open buryat names page', function () {
    $response = httpClient()->request('GET', '/buryat-names');
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toContain('<h1>Бурятские имена</h1>');
});

test('open books page', function () {
    $response = httpClient()->request('GET', '/books');
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toContain('<h1 class="hidden-xs">Книги</h1>');
});

test('open book view page', function () {
    $response = httpClient()->request('GET', '/book/ucebnik-buratskogo-azyka');
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toContain('<h1 class="hidden-xs">Учебник бурятского языка</h1>');
});

test('open news page', function () {
    $response = httpClient()->request('GET', '/news');
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toContain('<h1 class="hidden-xs">Новости</h1>');
});

test('open contacts page', function () {
    $response = httpClient()->request('GET', '/contacts');
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toContain('<h1>Контакты</h1>');
});

test('open login page', function () {
    $response = httpClient()->request('GET', '/login');
    expect($response->getStatusCode())->toBe(200);
    expect($response->getContent())->toContain('<h3 class="panel-title">Вход</h3>');
});
