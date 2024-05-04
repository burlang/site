<?php

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

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $user = User::findOne($id);

        if ($user === null) {
            return null;
        }

        return new self($user->id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('Method "findIdentityByAccessToken" is not implemented.');
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return "";
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return true;
    }
}
