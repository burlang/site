<?php

declare(strict_types=1);

namespace app\controllers;

use Throwable;
use yii\db\Connection;
use yii\filters\ContentNegotiator;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class HealthController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors(): array
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    '*/*' => Response::FORMAT_JSON,
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
                ],
            ],
        ];
    }

    public function actionIndex(Connection $db): Response
    {
        try {
            $db->createCommand('SELECT 1')->execute();
        } catch (Throwable $e) {
            $this->response->statusCode = 503;
            return $this->asJson(['status' => 'error']);
        }

        return $this->asJson(['status' => 'ok']);
    }
}
