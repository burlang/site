<?php

declare(strict_types=1);

return [
    'news/<action:(create|update|delete)>' => 'news/<action>',
    'news' => 'news/index',
    'news/<slug:[\w-]+>' => 'news/view',

    'book/<action:(create|update|delete|chapter-create|chapter-update|chapter-delete)>' => 'book/<action>',
    'books' => 'book/index',
    'book/<slug:[\w-]+>' => 'book/view',
    'book/<slug:[\w-]+>/<chapterSlug:[\w-]+>' => 'book/chapter',

    'buryat-names' => 'buryat-name/index',
    'buryat-name/list' => 'buryat-name/list',
    'buryat-names/letter/<letter:\w{1}>' => 'buryat-name/letter',
    'buryat-name/<name>' => 'buryat-name/view',

    'contacts' => 'site/contacts',

    'login' => 'auth/login',
    'logout' => 'auth/logout',

    // api v1
    'api/v1/names' => 'api/v1/buryat-name/index',
    'api/v1/names/<action>' => 'api/v1/buryat-name/<action>',
    'api/v1/buryat-word/<action>' => 'api/v1/buryat-word/<action>',
    'api/v1/russian-word/<action>' => 'api/v1/russian-word/<action>',
    'api/v1/news' => 'api/v1/news/index',
    'api/v1/news/get-news' => 'api/v1/news/get-news',
    // api v1 old
    'v1/names/<action>' => 'api/v1/buryat-name/<action>',
    'v1/buryat-word/<action>' => 'api/v1/buryat-word/<action>',
    'v1/russian-word/<action>' => 'api/v1/russian-word/<action>',
];
