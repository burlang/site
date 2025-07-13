<?php

declare(strict_types=1);

use app\components\AuthIdentity;
use yii\helpers\ArrayHelper;
use yii\web\ErrorHandler;
use yii\web\JsonParser;
use yii\web\Request;
use yii\web\Response;
use yii\web\Session;
use yii\web\User;

/** @var array<string, mixed> */
$common = require __DIR__ . '/common.php';

return ArrayHelper::merge(
    $common,
    [
        'components' => [
            'user' => User::class,
            'request' => Request::class,
            'response' => Response::class,
            'session' => Session::class,
            'errorHandler' => [
                'class' => ErrorHandler::class,
                'errorAction' => 'site/error',
            ],
        ],
        'container' => [
            'singletons' => [
                User::class => [
                    'class' => User::class,
                    'identityClass' => AuthIdentity::class,
                    'loginUrl' => ['auth/login'],
                    'enableAutoLogin' => true,
                ],
                Request::class => [
                    'class' => Request::class,
                    'cookieValidationKey' => env('COOKIE_SECRET'),
                    'parsers' => [
                        'application/json' => JsonParser::class,
                    ],
                ],
                Response::class => [
                    'class' => Response::class,
                ],
                Session::class => [
                    'class' => Session::class,
                ],
            ],
        ],
    ],
);
