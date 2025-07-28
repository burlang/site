<?php

declare(strict_types=1);

namespace app\enums;

enum RoleEnum: string
{
    case USER = 'user';
    case MODERATOR = 'moderator';
    case ADMIN = 'admin';

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            self::USER->value => 'Пользователь',
            self::MODERATOR->value => 'Модератор',
            self::ADMIN->value => 'Администратор',
        ];
    }
}
