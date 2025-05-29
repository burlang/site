<?php

declare(strict_types=1);

namespace app\assets;

use yii\web\AssetBundle;

class CodeMirrorAsset extends AssetBundle
{
    public $sourcePath = '@npm/codemirror';
    /** @var string[] */
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
    /** @var string[] */
    public $css = [
        'lib/codemirror.css',
    ];
}
