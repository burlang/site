<?php

declare(strict_types=1);

namespace app\enums;

enum PermissionEnum: string
{
    case BURYAT_WORDS_MANAGEMENT = 'buryat_words_management';
    case RUSSIAN_WORDS_MANAGEMENT = 'russian_words_management';
    case BURYAT_NAMES_MANAGEMENT = 'buryat_names_management';
    case BOOKS_MANAGEMENT = 'books_management';
    case NEWS_MANAGEMENT = 'news_management';
    case DICTIONARIES_MANAGEMENT = 'dictionaries_management';
    case DICTIONARIES_DELETE = 'dictionaries_delete';
    case STATISTICS_VIEW = 'statistics_view';
}
