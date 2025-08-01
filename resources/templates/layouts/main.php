<?php

use app\assets\AppAsset;
use app\enums\PermissionEnum;
use app\enums\RoleEnum;
use yii\bootstrap\Html as BootstrapHtml;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

/**
 * @var View $this
 * @var string $content
 */
AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= webApp()->language; ?>">

<head>
    <meta charset="<?= webApp()->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="shortcut icon" href="<?= alias('@web/favicon.ico'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= alias('@web/favicon.png'); ?>">

    <?= Html::csrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?></title>

    <?php $this->head(); ?>
    <?php $this->registerMetaTag([
        'name' => 'keywords',
        'content' => 'burlang, burlang.ru, buryat-lang, buryat-lang.ru, buryat, бурятский словарь, бурятские имена, онлайн словарь',
    ]); ?>
    <?php $this->registerMetaTag([
        'name' => 'description',
        'content' => 'Русско-Бурятский, Бурятско-Русский электронный словарь',
    ]); ?>

    <?php if (isset($this->blocks['head'])): ?>
        <?= $this->blocks['head']; ?>
    <?php endif; ?>
</head>

<body>
    <?php $this->beginBody(); ?>
    <div class="wrap">
        <?php NavBar::begin([
            'brandLabel' => webApp()->name,
            'brandUrl' => webApp()->homeUrl,
            'options' => ['class' => 'navbar-inverse navbar-fixed-top'],
        ]); ?>
        <?= Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                [
                    'label' => 'Словарь',
                    'url' => webApp()->homeUrl,
                    'active' => isRouteActive('site/index'),
                ],
                [
                    'label' => 'Бурятские имена',
                    'url' => ['/buryat-name/index'],
                    'active' => isRoutePrefixActive('buryat-name/'),
                ],
                [
                    'label' => 'Книги',
                    'url' => ['/book/index'],
                    'active' => isRoutePrefixActive('book/'),
                ],
                [
                    'label' => 'Новости',
                    'url' => ['/news/index'],
                    'active' => isRoutePrefixActive('news/'),
                ],
                [
                    'label' => 'Контакты',
                    'url' => ['/site/contacts'],
                    'active' => isRouteActive('site/contacts'),
                ],
                can(RoleEnum::MODERATOR->value)
                    ? [
                        'label' => 'Управление',
                        'items' => [
                            [
                                'label' => 'Бурятские имена',
                                'url' => ['/admin/buryat-name/index'],
                                'visible' => can(PermissionEnum::BURYAT_NAMES_MANAGEMENT->value),
                            ],
                            [
                                'label' => 'Бурятские слова',
                                'url' => ['/buryat-word/index'],
                                'visible' => can(PermissionEnum::BURYAT_WORDS_MANAGEMENT->value),
                            ],
                            [
                                'label' => 'Русские слова',
                                'url' => ['/russian-word/index'],
                                'visible' => can(PermissionEnum::RUSSIAN_WORDS_MANAGEMENT->value),
                            ],
                            [
                                'label' => 'Словари',
                                'url' => ['/dictionary/index'],
                                'visible' => can(PermissionEnum::DICTIONARIES_MANAGEMENT->value),
                            ],
                            [
                                'label' => 'Статистика',
                                'url' => ['/statistics'],
                                'visible' => can(PermissionEnum::STATISTICS_VIEW->value),
                            ],
                        ],
                    ]
                    : '',
                isGuest()
                    ? ['label' => 'Войти', 'url' => ['/auth/login']]
                    : [
                        'label' => BootstrapHtml::icon('user'),
                        'encode' => false,
                        'items' => [
                            [
                                'label' => 'Выйти',
                                'url' => ['/auth/logout'],
                                'linkOptions' => ['data-method' => 'post'],
                            ],
                        ],
                        'options' => [
                            'id' => 'dropdown-profile',
                        ],
                    ],
            ],
        ]); ?>
        <?php NavBar::end(); ?>
        <div class="container">
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs'] ?? []]); ?>
            <?= $content; ?>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <?= Menu::widget([
                        'items' => [
                            [
                                'label' => 'Github',
                                'url' => 'https://github.com/burlang',
                            ],
                            [
                                'label' => 'Api',
                                'url' => ['/api/v1'],
                            ],
                        ],
                        'options' => [
                            'class' => 'list-inline',
                        ],
                    ]); ?>
                </div>
                <div class="col-sm-4 text-center">
                    <span class="label label-default">
                        &copy; <?= webApp()->name; ?> 2013 - <?= date('Y'); ?>
                    </span>
                </div>
            </div>
        </div>
    </footer>
    <?php $this->endBody(); ?>
    <?php if (env('APP_ENV') === 'prod'): ?>
        <script async src="https://scripts.simpleanalyticscdn.com/latest.js"></script>
    <?php endif; ?>
</body>

</html>
<?php $this->endPage(); ?>