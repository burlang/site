<?php

declare(strict_types=1);

use yii\helpers\Html;

/**
 * @var array<int, array<int, string>> $nameGroups
 */
?>
<?php if (!empty($nameGroups)): ?>
    <div>
        <?php foreach ($nameGroups as $letter => $nameGroup): ?>
            <div class="mb-20">
                <h3><?= Html::encode((string)$letter); ?></h3>
                <?php foreach ($nameGroup as $name): ?>
                    <?= Html::a(
                        Html::encode($name),
                        ['view', 'name' => $name],
                        ['class' => 'btn btn-default mb-4']
                    ); ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <h3>Имена не найдены</h3>
<?php endif; ?>
