<?php

use app\models\BuryatWord;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var BuryatWord $model
 * @var array $dictionaries
 */

$this->title = 'Новое слово';
$this->params['breadcrumbs'][] = ['label' => 'Бурятские слова', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buryat-word-create">
    <h1 class="hidden-xs"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'dictionaries' => $dictionaries,
    ]) ?>
</div>
