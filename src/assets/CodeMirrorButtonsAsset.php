<?php

declare(strict_types=1);

namespace app\assets;

use yii\web\AssetBundle;

class CodeMirrorButtonsAsset extends AssetBundle
{
    public $sourcePath = '@bower/codemirror-buttons';
    /** @var string[] */
    public $js = [
        'buttons.js',
    ];
}
