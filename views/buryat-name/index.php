<?php

use app\components\DeviceDetect\DeviceDetectInterface;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var array $names
 * @var string $letter
 * @var DeviceDetectInterface $deviceDetect
 * @var array $firstLetters
 */

$this->title = 'Имена';
if ($letter) {
    $this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
    $this->params['breadcrumbs'][] = $letter;
} else {
    $this->params['breadcrumbs'][] = $this->title;
}
?>
<div class="buryat-name-list" data-url="<?= Url::to(['buryat-name/view-name']) ?>">
    <h1 class="hidden-xs"><?= Html::encode($this->title) ?></h1>
    <?php if (!$letter || $deviceDetect->isDesktop() || $deviceDetect->isTablet()): ?>
        <?= $this->render('_first_letters', [
            'currentLetter' => $letter,
            'firstLetters' => $firstLetters,
        ]) ?>
    <?php endif ?>
    <?php if (!empty($names)): ?>
        <ul class="list-inline list-name">
            <?php foreach ($names as $name): ?>
                <li>
                    <?= Html::a(
                        $name,
                        ['view-name', 'name' => $name],
                        ['class' => 'btn btn-default js-link-name']
                    ) ?>
                </li>
            <?php endforeach ?>
        </ul>
        <div class="modal fade" id="view-name-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Закрыть
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>
