<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class MarkdownEditorAsset extends AssetBundle
{
    public $sourcePath = '@app/assets/markdown';
    public $js = [
        'editor.js',
    ];
    public $css = [
        'editor.css',
    ];
    public $depends = [
        JqueryAsset::class,
        CodeMirrorAsset::class,
        CodeMirrorButtonsAsset::class,
    ];
}
