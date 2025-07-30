<?php

use app\components\DeviceDetector\DeviceDetectorInterface;
use app\models\RussianTranslation;
use app\models\RussianWord;
use app\widgets\FlashMessages;
use yii\bootstrap\Html;
use yii\web\View;

/**
 * @var View $this
 * @var RussianWord $model
 * @var RussianTranslation $translationForm
 * @var array<int, string> $dictionaries
 * @var DeviceDetectorInterface $deviceDetector
 */
$this->title = 'Редактировать: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Русские слова', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="russian-word-update">
    <h1 class="hidden-xs"><?= Html::encode($this->title); ?></h1>
    <?= FlashMessages::widget(); ?>
    <?= $this->render('_form', [
        'model' => $model,
        'dictionaries' => $dictionaries,
    ]); ?>
    <?= $this->render('_translation_form', [
        'model' => $model,
        'translationForm' => $translationForm,
        'dictionaries' => $dictionaries,
        'deviceDetector' => $deviceDetector,
    ]); ?>
</div>
