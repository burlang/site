<?php

declare(strict_types=1);

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class MarkdownEditorAsset extends AssetBundle
{
    public $baseUrl = '@web/build/markdown';
    /** @var string[] */
    public $js = [
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
        CodeMirrorButtonsAsset::class,
        SendKeysAsset::class,
    ];
}
