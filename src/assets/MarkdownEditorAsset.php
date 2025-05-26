<?php

declare(strict_types=1);

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class MarkdownEditorAsset extends AssetBundle
{
    public $sourcePath = '@root/resources/assets/markdown-editor';
    /** @var string[] */
    public $js = [
        'buttons.js',
        'editor.js',
    ];
    /** @var string[] */
    public $css = [
        'editor.css',
    ];
    /** @var string[] */
    public $depends = [
        JqueryAsset::class,
        CodeMirrorAsset::class,
    ];
}
