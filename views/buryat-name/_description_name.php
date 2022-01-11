<?php

use app\models\BuryatName;

/**
 * @var BuryatName $model
 */
?>
<div class="alert alert-success mb-0">
    <h4><strong><?= $model->description ?></strong></h4>
    <?php if ($model->note): ?>
        <p><?= $model->note ?></p>
    <?php endif ?>
    <div class="mt-10">
        <?php if ($model->male): ?>
            <span class="label label-default">Мужское имя</span>
        <?php endif ?>
        <?php if ($model->female): ?>
            <span class="label label-default">Женское имя</span>
        <?php endif ?>
    </div>
</div>
