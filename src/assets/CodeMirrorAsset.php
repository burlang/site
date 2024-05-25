<?php

namespace app\assets;

use yii\web\AssetBundle;

class CodeMirrorAsset extends AssetBundle
{
    public $sourcePath = '@bower/codemirror';
    public $js = [
        'lib/codemirror.js',
        // markdown and gfm
        'mode/meta.js',
        'mode/markdown/markdown.js',
        'addon/mode/overlay.js',
        'mode/gfm/gfm.js',
        'addon/edit/continuelist.js',
        // for controls
        'addon/display/panel.js',
    ];
    public $css = [
        'lib/codemirror.css',
    ];
}
