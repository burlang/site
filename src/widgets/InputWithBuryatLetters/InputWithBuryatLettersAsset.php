<?php

declare(strict_types=1);

namespace app\widgets\InputWithBuryatLetters;

use app\assets\SendKeysAsset;
use yii\web\AssetBundle;

final class InputWithBuryatLettersAsset extends AssetBundle
{
    public $js = [
        'input-with-buryat-letters.js',
    ];
    public $depends = [
        SendKeysAsset::class,
    ];

    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }
}
