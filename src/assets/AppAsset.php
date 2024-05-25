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
    public $css = [
        'build/css/main.css',
    ];
    public $js = [
        'build/js/main.js',
    ];
    public $jsOptions = [
        'position'=> View::POS_END,
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        HtmxAsset::class,
    ];
}
