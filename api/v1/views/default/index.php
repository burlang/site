<?php

/**
 * @var yii\web\View $this
 */

$this->title = 'Api v1';
$this->params['breadcrumbs'][] = $this->title;

$host = Yii::$app->request->getHostInfo();
?>

<div class="v1-default-index">
    <h1><?= $this->title ?></h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= Yii::t('app', 'Buryat words') ?>
            </h4>
        </div>
        <div class="panel-body">
            <ul>
                <li>
                    <code><?= $host ?>/v1/buryat-word/get-words?q=с...</code>
                </li>
                <li>
                    <code><?= $host ?>/v1/buryat-word/get-translate?word=сайн</code>
                </li>
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <?= Yii::t('app', 'Russian words') ?>
            </h4>
        </div>
        <div class="panel-body">
            <ul>
                <li>
                    <code><?= $host ?>/v1/russian-word/get-words?q=с...</code>
                </li>
                <li>
                    <code><?= $host ?>/v1/russian-word/get-translate?word=привет</code>
                </li>
            </ul>  
        </div>
    </div>
</div>