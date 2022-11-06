<?php

use app\assets\AppAsset;
use app\components\PageMenu;
use app\widgets\Counters;
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
                'active' => Yii::$app->controller->id === 'site' && Yii::$app->controller->action->id === 'index'
            ],
            [
                'label' => 'Бурятские имена',
                'url' => ['/buryat-name/index'],
                'active' => get_class(Yii::$app->controller) === \app\controllers\BuryatNameController::class,
            ],
            [
                'label' => 'Книги',
                'url' => ['/book/index'],
                'active' => Yii::$app->controller->id === 'book',
            ],
            [
                'label' => 'Новости',
                'url' => ['/news/index'],
                'active' => Yii::$app->controller->id === 'news'
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
            <div class="col-sm-6">
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
            <div class="col-sm-6 text-right">
                <?= Html::mailto('dbulats88@gmail.com') ?>
                <?= Html::mailto('bairdarmaev@gmail.com') ?>
            </div>
        </div>
        <h5 class="text-center">
            <span class="label label-default">
                &copy; <?= Yii::$app->name ?> 2013 - <?= date('Y') ?>
            </span>
        </h5>
    </div>
</footer>
<?= Counters::widget() ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
