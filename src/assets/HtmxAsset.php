<?php

declare(strict_types=1);

namespace app\assets;

use yii\web\AssetBundle;

final class HtmxAsset extends AssetBundle
{
    public $sourcePath = '@npm/htmx.org';
    /** @var string[] */
    public $js = [
        'dist/htmx.js',
    ];
}
