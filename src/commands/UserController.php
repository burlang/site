<?php

declare(strict_types=1);

namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class UserController extends Controller
{
    public function actionList(): int
    {
        $users = User::find()->all();

        foreach ($users as $user) {
            $this->stdout("Username: {$user->username} (Role: {$user->role})\n", Console::FG_GREEN);
        }

        return ExitCode::OK;
    }

    public function actionChangeRole(): int
    {
        $username = $this->prompt('Enter username:', [
            'required' => true,
        ]);

        $user = User::findOne(['username' => $username]);
        if ($user === null) {
            $this->stderr("User not found: {$username}\n", Console::FG_RED);
            return ExitCode::DATAERR;
        }

        $user->role = $this->select('Select role:', User::roles());
        if (!$user->save()) {
            $this->stderr("Failed to save user: {$username}\n", Console::FG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $this->stdout("Role changed: {$username}\n", Console::FG_GREEN);

        return ExitCode::OK;
    }
}
