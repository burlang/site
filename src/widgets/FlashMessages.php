<?php

namespace app\widgets;

use Yii;
use yii\bootstrap\Alert;
use yii\bootstrap\Widget;

class FlashMessages extends Widget
{
    public array $alertTypes = [
        'error' => 'alert-danger',
        'danger' => 'alert-danger',
        'success' => 'alert-success',
        'info' => 'alert-info',
        'warning' => 'alert-warning',
    ];

    public array $closeButton = [];

    public function init(): void
    {
        parent::init();

        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();
        $appendCss = isset($this->options['class']) ? ' ' . $this->options['class'] : '';

        foreach ($flashes as $type => $data) {
            if (isset($this->alertTypes[$type])) {
                $data = (array)$data;
                foreach ($data as $i => $message) {
                    $this->options['class'] = $this->alertTypes[$type] . $appendCss;
                    $this->options['id'] = $this->getId() . '-' . $type . '-' . $i;
                    echo Alert::widget([
                        'body' => $message,
                        'closeButton' => $this->closeButton,
                        'options' => $this->options,
                    ]);
                }
                $session->removeFlash($type);
            }
        }
    }
}
