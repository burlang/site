<?php

declare(strict_types=1);

namespace app\assets;

use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\View;
use yii\web\YiiAsset;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    /** @var string[] */
    public $css = [
        'build/css/main.css',
    ];
    /** @var string[] */
    public $js = [
        'build/js/main.js',
    ];
    /** @var array<string, int> */
    public $jsOptions = [
        'position'=> View::POS_END,
    ];
    /** @var string[] */
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        HtmxAsset::class,
    ];
}
