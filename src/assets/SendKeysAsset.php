<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class SendKeysAsset extends AssetBundle
{
    public $sourcePath = '@bower/bililiterange/';
    public $js = [
        'bililiteRange.js',
        'jquery.sendkeys.js',
    ];
    public $depends = [
        JqueryAsset::class,
    ];
}
