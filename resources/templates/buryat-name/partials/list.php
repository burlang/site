<?php

declare(strict_types=1);

use yii\helpers\Html;

/**
 * @var string[] $names
 */

$numberOfColumns = 4;
$numberOfNamesPerColumn = (int)(ceil(count($names) / $numberOfColumns));
?>
<?php if ($names): ?>
    <div class="row">
        <?php foreach (array_chunk($names, $numberOfNamesPerColumn) as $namesForColumn): ?>
            <div class="col-md-3">
                <?php foreach ($namesForColumn as $name): ?>
                    <div>
                        <?= Html::a(
                            $name,
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
