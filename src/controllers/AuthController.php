<?php

declare(strict_types=1);

namespace app\controllers;

use app\components\AuthIdentity;
use app\forms\LoginForm;
use yii\base\Security;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use yii\web\User;

class AuthController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                    'login' => ['get', 'post'],
                ],
            ],
        ];
    }

    /**
     * @param User<AuthIdentity> $user
     */
    public function actionLogin(User $user, Security $security): Response|string
    {
        if (!$user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm($security);
        if (
            $model->load((array)$this->request->post())
            && $model->validate()
            && $model->login($user)
        ) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * @param User<AuthIdentity> $user
     */
    public function actionLogout(User $user): Response
    {
        $user->logout();
        return $this->goHome();
    }
}
