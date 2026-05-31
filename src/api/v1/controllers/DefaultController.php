<?php

declare(strict_types=1);

namespace app\api\v1\controllers;

use OpenApi\Generator;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\ServerErrorHttpException;

class DefaultController extends Controller
{
    public function init(): void
    {
        parent::init();
        $this->viewPath = '@templates/api/v1/default';
    }

    public function actionIndex(): string
    {
        $this->layout = false;
        return $this->render('index');
    }

    public function actionSpec(): Response
    {
        $openapi = (new Generator())->generate([Yii::getAlias('@app/api/v1')]);
        if ($openapi === null) {
            throw new ServerErrorHttpException('Failed to generate OpenAPI spec');
        }

        $this->response->format = Response::FORMAT_RAW;
        $this->response->headers->set('Content-Type', 'application/json');
        $this->response->data = $openapi->toJson();

        return $this->response;
    }
}
