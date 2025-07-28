<?php

declare(strict_types=1);

use app\enums\PermissionEnum;
use app\enums\RoleEnum;
use yii\rbac\Item;

return [
    // permissions
    PermissionEnum::BURYAT_WORDS_MANAGEMENT->value => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление бурятскими словами',
        'ruleName' => null,
        'data' => null,
    ],
    PermissionEnum::RUSSIAN_WORDS_MANAGEMENT->value => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление русскими словами',
        'ruleName' => null,
        'data' => null,
    ],
    PermissionEnum::BURYAT_NAMES_MANAGEMENT->value => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление именами',
        'ruleName' => null,
        'data' => null,
    ],
    PermissionEnum::BOOKS_MANAGEMENT->value => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление книгами',
        'ruleName' => null,
        'data' => null,
    ],
    PermissionEnum::NEWS_MANAGEMENT->value => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление новостями',
        'ruleName' => null,
        'data' => null,
    ],
    PermissionEnum::DICTIONARIES_MANAGEMENT->value => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление словарями',
        'ruleName' => null,
        'data' => null,
    ],
    PermissionEnum::DICTIONARIES_DELETE->value => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Удаление словарей',
        'ruleName' => null,
        'data' => null,
    ],
    PermissionEnum::STATISTICS_VIEW->value => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Просмотр статистики',
        'ruleName' => null,
        'data' => null,
    ],

    // roles
    RoleEnum::USER->value => [
        'type' => Item::TYPE_ROLE,
        'description' => 'Пользователь',
        'children' => [],
        'ruleName' => null,
        'data' => null,
    ],
    RoleEnum::MODERATOR->value => [
        'type' => Item::TYPE_ROLE,
        'description' => 'Модератор',
        'children' => [
            RoleEnum::USER->value,
            PermissionEnum::BURYAT_WORDS_MANAGEMENT->value,
            PermissionEnum::RUSSIAN_WORDS_MANAGEMENT->value,
            PermissionEnum::BURYAT_NAMES_MANAGEMENT->value,
            PermissionEnum::BOOKS_MANAGEMENT->value,
            PermissionEnum::DICTIONARIES_MANAGEMENT->value,
        ],
        'ruleName' => null,
        'data' => null,
    ],
    RoleEnum::ADMIN->value => [
        'type' => Item::TYPE_ROLE,
        'description' => 'Администратор',
        'children' => [
            RoleEnum::MODERATOR->value,
            PermissionEnum::NEWS_MANAGEMENT->value,
            PermissionEnum::STATISTICS_VIEW->value,
            PermissionEnum::DICTIONARIES_DELETE->value,
        ],
        'ruleName' => null,
        'data' => null,
    ],
];
