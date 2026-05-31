<?php

declare(strict_types=1);

namespace app\assets;

use yii\web\AssetBundle;

final class HtmxCsrfAsset extends AssetBundle
{
    public $sourcePath = '@root/resources/assets';

    /** @var string[] */
    public $js = [
        'js/htmx-csrf.js',
    ];

    /** @var array<class-string> */
    public $depends = [
        HtmxAsset::class,
    ];
}
