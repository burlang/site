<?php

declare(strict_types=1);

namespace app\forms;

use app\components\AuthIdentity;
use app\models\User;
use yii\base\Model;
use yii\base\Security;
use yii\web\User as WebUser;

class LoginForm extends Model
{
    public string $username = '';
    public string $password = '';

    private false|User|null $user = false;

    private Security $security;

    public function __construct(Security $security, array $config = [])
    {
        parent::__construct($config);
        $this->security = $security;
    }

    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['username', 'string', 'min' => 3, 'max' => 255],
            ['password', 'string', 'min' => 5, 'max' => 72],
            ['username', 'validateBlocked'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributeLabels(): array
    {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
        ];
    }

    public function validateBlocked(string $attribute): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ($user?->isBlocked()) {
                $this->addError($attribute, 'Ваш аккаунт заблокирован.');
            }
        }
    }

    public function validatePassword(string $attribute): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$this->security->validatePassword($this->password, $user->password_hash)) {
                $this->addError($attribute, 'Неверное имя пользователя или пароль.');
            }
        }
    }

    /**
     * @param WebUser<AuthIdentity> $webUser
     */
    public function login(WebUser $webUser): bool
    {
        $user = $this->getUser();
        if ($user !== null) {
            $isLogged = $webUser->login(new AuthIdentity((int)$user->id), 3600 * 24);
            if ($isLogged) {
                $user->recordLogin();
            }
            return $isLogged;
        }
        return false;
    }

    public function clearPassword(): void
    {
        $this->password = '';
    }

    private function getUser(): ?User
    {
        if ($this->user === false) {
            /** @var User|null $user */
            $user = User::find()
                ->where(['username' => $this->username])
                ->one();
            $this->user = $user;
        }

        return $this->user;
    }
}
