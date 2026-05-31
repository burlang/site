<?php

declare(strict_types=1);

namespace app\components\Translator;

enum TranslationProvider: string
{
    case Google = 'google';
    case Yandex = 'yandex';
}
