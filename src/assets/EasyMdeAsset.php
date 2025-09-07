<?php

declare(strict_types=1);

namespace app\assets;

use yii\web\AssetBundle;

final class EasyMdeAsset extends AssetBundle
{
    public $sourcePath = '@npm/easymde/dist';
    /** @var string[] */
    public $js = [
        'easymde.min.js',
    ];
    /** @var string[] */
    public $css = [
        'easymde.min.css',
    ];
}
