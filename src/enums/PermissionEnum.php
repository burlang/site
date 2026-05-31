<?php

declare(strict_types=1);

namespace app\enums;

enum PermissionEnum: string
{
    case BuryatWordsManagement = 'buryat_words_management';
    case RussianWordsManagement = 'russian_words_management';
    case BuryatNamesManagement = 'buryat_names_management';
    case NewsManagement = 'news_management';
    case DictionariesManagement = 'dictionaries_management';
    case DictionariesDelete = 'dictionaries_delete';
    case StatisticsView = 'statistics_view';
}
