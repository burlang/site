<?php

declare(strict_types=1);

namespace app\widgets;

use yii\base\Widget;

final class MailTo extends Widget
{
    public string $email;

    public function run(): string
    {
        return $this->render('mail-to', ['email' => $this->email]);
    }
}
