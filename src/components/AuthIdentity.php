<?php

declare(strict_types=1);

namespace app\components;

use app\models\User;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

class AuthIdentity implements IdentityInterface
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public static function findIdentity($id)
    {
        $user = User::findOne($id);

        if ($user === null) {
            return null;
        }

        return new self($user->id);
    }

    public static function findIdentityByAccessToken($token, $type = null): void
    {
        throw new NotSupportedException('Method "findIdentityByAccessToken" is not implemented.');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return '';
    }

    public function validateAuthKey($authKey)
    {
        return true;
    }
}
