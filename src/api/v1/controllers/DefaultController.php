<?php

declare(strict_types=1);

namespace app\api\v1\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function init(): void
    {
        parent::init();
        $this->viewPath = '@templates/api/v1/default';
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
