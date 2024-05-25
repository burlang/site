<?php

namespace app\api\v1\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function init()
    {
        parent::init();
        $this->viewPath = '@templates/api/v1/default';
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }
}
