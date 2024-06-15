<?php

declare(strict_types=1);

use yii\helpers\Html;

/**
 * @var array<int, <int, string>> $nameGroups
 */
?>
<?php if (!empty($nameGroups)): ?>
    <div class="row">
        <?php foreach ($nameGroups as $nameGroup): ?>
            <div class="col-md-3">
                <?php foreach ($nameGroup as $name): ?>
                    <div>
                        <?= Html::a(
                            Html::encode($name),
                            ['view', 'name' => $name],
                            ['class' => 'btn btn-default mb-5']
                        ) ?>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endforeach ?>
    </div>
<?php else: ?>
    <h3>Имена не найдены</h3>
<?php endif ?>
