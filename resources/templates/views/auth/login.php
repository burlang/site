<?php

use app\forms\LoginForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var LoginForm $model
 */
$this->title = 'Вход';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title); ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username', [
                    'inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1'],
                ]); ?>

                <?= $form->field($model, 'password', [
                    'inputOptions' => ['class' => 'form-control', 'tabindex' => '2'],
                ])->passwordInput(); ?>

                <?= Html::submitButton(
                    'Войти',
                    ['class' => 'btn btn-custom btn-block', 'tabindex' => '4']
                ); ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
