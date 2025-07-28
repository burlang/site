<?php

declare(strict_types=1);

namespace app\components\Grid;

use yii\bootstrap\Html;
use yii\grid\ActionColumn as Column;

class ActionColumn extends Column
{
    protected function initDefaultButtons(): void
    {
        if (!isset($this->buttons['view'])) {
            $this->buttons['view'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => 'Просмотр',
                    'class' => 'btn btn-sm btn-default',
                    'aria-label' => 'Просмотр',
                    'data-pjax' => '0',
                ], $this->buttonOptions);
                return Html::a(Html::icon('eye-open'), $url, $options);
            };
        }
        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => 'Редактировать',
                    'class' => 'btn btn-sm btn-primary',
                    'aria-label' => 'Редактировать',
                    'data-pjax' => '0',
                ], $this->buttonOptions);
                return Html::a(Html::icon('pencil'), $url, $options);
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => 'Удалить',
                    'class' => 'btn btn-sm btn-danger',
                    'aria-label' => 'Удалить',
                    'data-confirm' => 'Вы уверены, что хотите удалить?',
                    'data-method' => 'post',
                    'data-pjax' => '0',
                ], $this->buttonOptions);
                return Html::a(Html::icon('trash'), $url, $options);
            };
        }
    }
}
