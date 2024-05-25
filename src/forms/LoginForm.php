<?php

namespace app\forms;

use app\components\AuthIdentity;
use app\models\User;
use Yii;
use yii\base\Model;
use yii\web\User as WebUser;

class LoginForm extends Model
{
    public string $username = '';
    public string $password = '';

    /** @var User|null|false */
    private $user = false;

    public function rules(): array
    {
        return [
            [['username', 'password'], 'required'],
            ['username', 'string', 'min' => 3, 'max' => 255],
            ['password', 'string', 'min' => 5, 'max' => 72],
            ['password', 'validatePassword'],
            [['username'], 'validateBlocked'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
        ];
    }

    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !Yii::$app->security->validatePassword($this->password, $user->password_hash)) {
                $this->addError($attribute, 'Неверное имя пользователя или пароль.');
            }
        }
    }

    public function validateBlocked($attribute)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if ($user && $user->isBlocked()) {
                $this->addError($attribute, 'Ваш аккаунт заблокирован.');
            }
        }
    }

    /**
     * @return bool whether the user is logged in successfully
     */
    public function login(WebUser $webUser)
    {
        $user = $this->getUser();
        if ($user) {
            $isLogged = $webUser->login(new AuthIdentity((int)$user->id), 3600 * 24);
            if ($isLogged) {
                $this->getUser()->updateAttributes(['last_login_at' => time()]);
            }
            return $isLogged;
        }
        return false;
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        if ($this->user === false) {
            $this->user = User::find()->where(['username' => $this->username])->one();
        }

        return $this->user;
    }
}
