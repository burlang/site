<?php

declare(strict_types=1);

namespace app\models;

use app\enums\RoleEnum;
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
    public static function tableName(): string
    {
        return 'user';
    }

    public function rules(): array
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
            ['role', 'in', 'range' => array_column(RoleEnum::cases(), 'value')],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'username' => 'Имя пользователя',
            'email' => 'Email',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function isBlocked(): bool
    {
        return $this->blocked_at !== null;
    }
}
