<?php

declare(strict_types=1);

namespace app\components;

use app\models\User;
use yii\rbac\Assignment;
use yii\rbac\PhpManager;

class AuthManager extends PhpManager
{
    public function getAssignments($userId): array
    {
        if (\array_key_exists($userId, $this->assignments)) {
            /** @var Assignment[] */
            return $this->assignments[$userId];
        }

        if (!$user = User::findOne($userId)) {
            return $this->assignments[$userId] = [];
        }

        return $this->assignments[$userId] = [
            $user->role => new Assignment([
                'userId' => $user->id,
                'roleName' => $user->role,
                'createdAt' => time(),
            ]),
        ];
    }
}
