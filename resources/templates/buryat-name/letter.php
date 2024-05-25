<?php

declare(strict_types=1);

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var string $letter
 */

$this->title = sprintf('Бурятские имена на букву "%s"', mb_strtoupper($letter));
$this->params['breadcrumbs'][] = ['label' => 'Бурятские имена', 'url' => ['index']];
$this->params['breadcrumbs'][] = sprintf('На букву "%s"', mb_strtoupper($letter));
?>
<h1><?= Html::encode($this->title) ?></h1>
<hr>
<div hx-get="<?= Url::to(['/buryat-name/list', 'letter' => $letter]) ?>" hx-trigger="load">
    <p class="text-center">Загрузка имен...</p>
</div>
