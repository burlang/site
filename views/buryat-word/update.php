<?php

use app\components\DeviceDetect\DeviceDetectInterface;
use app\models\BuryatTranslation;
use app\models\BuryatWord;
use app\widgets\FlashMessages;
use yii\bootstrap\Html;
use yii\web\View;

/**
 * @var View $this
 * @var BuryatWord $model
 * @var BuryatTranslation $translationForm
 * @var array $dictionaries
 * @var DeviceDetectInterface $deviceDetect
 */

$this->title = 'Редактировать: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Бурятские слова', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buryat-word-update">
    <h1 class="hidden-xs"><?= Html::encode($this->title) ?></h1>
    <?= FlashMessages::widget() ?>
    <?= $this->render('_form', [
        'model' => $model,
        'dictionaries' => $dictionaries,
    ]) ?>
    <?= $this->render('_translation_form', [
        'model' => $model,
        'translationForm' => $translationForm,
        'dictionaries' => $dictionaries,
        'deviceDetect' => $deviceDetect,
    ]) ?>
</div>
