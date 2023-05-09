<?php

use app\assets\AppAsset;
use app\components\PageMenu;
use app\widgets\Counters;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

/**
 * @var View $this
 * @var string $content
 */

AppAsset::register($this);
$route = Yii::$app->controller->getRoute();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="shortcut icon" href="<?= Yii::getAlias('@web/favicon.ico') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= Yii::getAlias('@web/favicon.png') ?>">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
    <?php $this->registerMetaTag([
        'name' => 'keywords',
        'content' => 'burlang, burlang.ru, buryat-lang, buryat-lang.ru, buryat, бурятский словарь, бурятские имена, онлайн словарь',
    ]) ?>
    <?php $this->registerMetaTag([
        'name' => 'description',
        'content' => 'Русско-Бурятский, Бурятско-Русский электронный словарь',
    ]) ?>

    <?php if (isset($this->blocks['head'])): ?>
        <?= $this->blocks['head'] ?>
    <?php endif ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]) ?>
    <?= Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label' => 'Словарь',
                'url' => Yii::$app->homeUrl,
                'active' => $route === 'site/index',
            ],
            [
                'label' => 'Бурятские имена',
                'url' => ['/buryat-name/index'],
                'active' => StringHelper::startsWith($route, 'buryat-name/'),
            ],
            [
                'label' => 'Книги',
                'url' => ['/book/index'],
                'active' => StringHelper::startsWith($route, 'book/'),
            ],
            [
                'label' => 'Новости',
                'url' => ['/news/index'],
                'active' => StringHelper::startsWith($route, 'news/'),
            ],
            [
                'label' => 'Контакты',
                'url' => ['/site/contacts'],
                'active' => $route === 'site/contacts',
            ],

            PageMenu::getItem('services'),
            PageMenu::getItem('about'),

            Yii::$app->user->can('moderator')
                ? [
                    'label' => 'Управление',
                    'items' => [
                        ['label' => 'Бурятские имена', 'url' => ['/admin/buryat-name/index']],
                        ['label' => 'Бурятские слова', 'url' => ['/buryat-word/index']],
                        ['label' => 'Русские слова', 'url' => ['/russian-word/index']],
                        ['label' => 'Словари', 'url' => ['/dictionary/index']],
                        Yii::$app->user->can('admin') ? '<li role="separator" class="divider"></li>' : '',
                        ['label' => 'Страницы', 'url' => ['/page/index'], 'visible' => Yii::$app->user->can('admin')],
                        ['label' => 'Статистика', 'url' => ['/statistics'], 'visible' => Yii::$app->user->can('admin')],
                        ['label' => 'Пользователи', 'url' => ['/user/admin/index'], 'visible' => Yii::$app->user->can('admin')],
                    ]
                ]
                : '',
            Yii::$app->user->isGuest
                ? ['label' => 'Войти', 'url' => ['/user/security/login']]
                : [
                    'label' => Yii::$app->user->identity->username,
                    'items' => [
                        ['label' => 'Профиль', 'url' => ['/user/profile/show', 'id' => Yii::$app->user->identity->id]],
                        '<li role="separator" class="divider"></li>',
                        ['label' => 'Выйти', 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']]
                    ],
                    'options' => [
                        'id' => 'dropdown-profile',
                    ],
                ],
        ],
    ]) ?>
    <?php NavBar::end() ?>
    <div class="container">
        <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs'] ?? []]) ?>
        <?= $content ?>
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
                            'url' => 'https://github.com/burlang/site',
                        ],
                        [
                            'label' => 'Api',
                            'url' => ['/api/v1'],
                        ],
                    ],
                    'options' => [
                        'class' => 'list-inline',
                    ],
                ]) ?>
            </div>
            <div class="col-sm-4 text-center">
                <span class="label label-default">
                    &copy; <?= Yii::$app->name ?> 2013 - <?= date('Y') ?>
                </span>
            </div>
        </div>
    </div>
</footer>
<?= Counters::widget() ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
