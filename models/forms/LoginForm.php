<?php

namespace app\models\forms;

use app\models\User;
use Yii;
use yii\base\Model;

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
            ['password', 'string', 'min' => 6, 'max' => 72],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !Yii::$app->security->validatePassword($this->password, $user->password_hash)) {
                $this->addError($attribute, 'Неверное имя пользователя или пароль.');
            }
        }
    }

    /**
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), 3600 * 24);
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
