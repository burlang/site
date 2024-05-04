<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * 
 * @property int|string|null $blocked_at
 * @property int|string|null $last_login_at
 * 
 * @property-read int|string $created_at
 * @property-read int|string $updated_at
 */
class User extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
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
        ];
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function behaviors()
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
