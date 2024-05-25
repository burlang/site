<?php

use app\models\search\BuryatWordSearch;
use app\widgets\InputWithBuryatLetters;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var BuryatWordSearch $model
 * @var ActiveForm $form
 */
?>
<div class="buryat-word-search">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Поиск</h4>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get']); ?>
            <?= $form->field($model, 'name')->widget(InputWithBuryatLetters::class) ?>
            <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Сбросить', ['class' => 'btn btn-default']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
