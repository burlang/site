<?php

declare(strict_types=1);

namespace app\enums;

enum RoleEnum: string
{
    case User = 'user';
    case Moderator = 'moderator';
    case Admin = 'admin';

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            self::User->value => 'Пользователь',
            self::Moderator->value => 'Модератор',
            self::Admin->value => 'Администратор',
        ];
    }
}
