<?php

use app\models\RussianWord;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var RussianWord $model
 * @var array $dictionaries
 */

$this->title = 'Новое слово';
$this->params['breadcrumbs'][] = ['label' => 'Русские слова', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="russian-word-create">
    <h1 class="hidden-xs"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'dictionaries' => $dictionaries,
    ]) ?>
</div>
