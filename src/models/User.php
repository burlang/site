<?php

declare(strict_types=1);

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $role
 *
 * @property int|string|null $blocked_at
 * @property int|string|null $last_login_at
 *
 * @property int|string $created_at
 * @property int|string $updated_at
 */
class User extends ActiveRecord
{
    public const ROLE_USER = 'user';
    public const ROLE_MODERATOR = 'moderator';
    public const ROLE_ADMIN = 'admin';

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            // username rules
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '/^[-a-zA-Z0-9_\.@]+$/'],
            ['username', 'string', 'min' => 3, 'max' => 255],
            [
                'username',
                'unique',
                'message' => 'Это имя пользователя уже занято',
            ],

            // email rules
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email',
                'unique',
                'message' => 'Этот адрес электронной почты уже занят',
            ],

            // role rules
            ['role', 'required'],
            ['role', 'string', 'max' => 60],
            ['role', 'in', 'range' => array_keys(self::roles())],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя пользователя',
            'email' => 'Email',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function roles(): array
    {
        return [
            self::ROLE_USER => 'Пользователь',
            self::ROLE_MODERATOR => 'Модератор',
            self::ROLE_ADMIN => 'Администратор',
        ];
    }

    public function isBlocked(): bool
    {
        return $this->blocked_at !== null;
    }
}
