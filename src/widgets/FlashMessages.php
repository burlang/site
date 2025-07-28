<?php

declare(strict_types=1);

namespace app\widgets;

use yii\bootstrap\Alert;
use yii\bootstrap\Widget;
use yii\web\Session;

class FlashMessages extends Widget
{
    /**
     * @var array<string, string>
     */
    public array $alertTypes = [
        'error' => 'alert-danger',
        'danger' => 'alert-danger',
        'success' => 'alert-success',
        'info' => 'alert-info',
        'warning' => 'alert-warning',
    ];

    /**
     * @var array<string, string>
     */
    public array $closeButton = [];

    private Session $session;

    public function __construct(Session $session, array $config = [])
    {
        $this->session = $session;
        parent::__construct($config);
    }

    public function init(): void
    {
        parent::init();

        $flashes = $this->session->getAllFlashes();
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
                $this->session->removeFlash($type);
            }
        }
    }
}
