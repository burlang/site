<?php

declare(strict_types=1);

use yii\rbac\Item;

return [
    // permissions
    'buryat_words_management' => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление бурятскими словами',
        'ruleName' => null,
        'data' => null,
    ],
    'russian_words_management' => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление русскими словами',
        'ruleName' => null,
        'data' => null,
    ],
    'buryat_names_management' => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление именами',
        'ruleName' => null,
        'data' => null,
    ],
    'books_management' => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление книгами',
        'ruleName' => null,
        'data' => null,
    ],
    'news_management' => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление новостями',
        'ruleName' => null,
        'data' => null,
    ],
    'pages_management' => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление страницами',
        'ruleName' => null,
        'data' => null,
    ],
    'dictionaries_management' => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление словарями',
        'ruleName' => null,
        'data' => null,
    ],
    'dictionaries_delete' => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Удаление словарей',
        'ruleName' => null,
        'data' => null,
    ],
    'statistics_view' => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Просмотр статистики',
        'ruleName' => null,
        'data' => null,
    ],

    // roles
    'user' => [
        'type' => Item::TYPE_ROLE,
        'description' => 'Пользователь',
        'children' => [],
        'ruleName' => null,
        'data' => null,
    ],
    'moderator' => [
        'type' => Item::TYPE_ROLE,
        'description' => 'Модератор',
        'children' => [
            'user',
            'buryat_words_management',
            'russian_words_management',
            'buryat_names_management',
            'books_management',
            'dictionaries_management',
        ],
        'ruleName' => null,
        'data' => null,
    ],
    'admin' => [
        'type' => Item::TYPE_ROLE,
        'description' => 'Администратор',
        'children' => [
            'moderator',
            'news_management',
            'pages_management',
            'statistics_view',
            'dictionaries_delete',
        ],
        'ruleName' => null,
        'data' => null,
    ],
];
