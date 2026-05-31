<?php

declare(strict_types=1);

use app\enums\PermissionEnum;
use app\enums\RoleEnum;
use yii\rbac\Item;

return [
    // permissions
    PermissionEnum::BuryatWordsManagement->value => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление бурятскими словами',
        'ruleName' => null,
        'data' => null,
    ],
    PermissionEnum::RussianWordsManagement->value => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление русскими словами',
        'ruleName' => null,
        'data' => null,
    ],
    PermissionEnum::BuryatNamesManagement->value => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление именами',
        'ruleName' => null,
        'data' => null,
    ],
    PermissionEnum::NewsManagement->value => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление новостями',
        'ruleName' => null,
        'data' => null,
    ],
    PermissionEnum::DictionariesManagement->value => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Управление словарями',
        'ruleName' => null,
        'data' => null,
    ],
    PermissionEnum::DictionariesDelete->value => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Удаление словарей',
        'ruleName' => null,
        'data' => null,
    ],
    PermissionEnum::StatisticsView->value => [
        'type' => Item::TYPE_PERMISSION,
        'description' => 'Просмотр статистики',
        'ruleName' => null,
        'data' => null,
    ],

    // roles
    RoleEnum::User->value => [
        'type' => Item::TYPE_ROLE,
        'description' => 'Пользователь',
        'children' => [],
        'ruleName' => null,
        'data' => null,
    ],
    RoleEnum::Moderator->value => [
        'type' => Item::TYPE_ROLE,
        'description' => 'Модератор',
        'children' => [
            RoleEnum::User->value,
            PermissionEnum::BuryatWordsManagement->value,
            PermissionEnum::RussianWordsManagement->value,
            PermissionEnum::BuryatNamesManagement->value,
            PermissionEnum::DictionariesManagement->value,
        ],
        'ruleName' => null,
        'data' => null,
    ],
    RoleEnum::Admin->value => [
        'type' => Item::TYPE_ROLE,
        'description' => 'Администратор',
        'children' => [
            RoleEnum::Moderator->value,
            PermissionEnum::NewsManagement->value,
            PermissionEnum::StatisticsView->value,
            PermissionEnum::DictionariesDelete->value,
        ],
        'ruleName' => null,
        'data' => null,
    ],
];
