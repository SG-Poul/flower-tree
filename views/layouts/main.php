<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
Yii::setAlias('@logout', 'user/default/logout');
AppAsset::register($this);

$dropdownMenu = [];
if (\Yii::$app->user->can('adminPermission')) {
    $dropdownMenu = [
        ['label' => 'Profile', 'url' => '/web/user'],
        ['label' => 'Orders',    'url' => '#'],
        ['label' => 'Change password',    'url' => '/web/user/default/change-password'],
        ['label' => 'Logout',    'url' => ['/logout'], ['data' => ['method' => 'post']]],
        '<li class="divider"></li>',
        '<li class="dropdown-header">ADMIN</li>',
        ['label' => 'Manage Products',  'url' => '/web/product/products'],
        ['label' => 'Manage Users',    'url' => '/web/user/admin'],
        ['label' => 'All Orders',    'url' => '#'],
    ];
} else {
    $dropdownMenu = [
        ['label' => 'Profile', 'url' => '/web/user'],
        ['label' => 'Orders',    'url' => '#'],
        ['label' => 'Change password',    'url' => '/web/user/default/change-password'],
        ['label' => 'Logout',    'url' => ['/logout'], ['data' => ['method' => 'post']]],
    ];
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Flowertree',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Sign in', 'url' => ['/login']]
            ) : (
            [
                'label' => Yii::$app->user->identity->username,
                'items' => $dropdownMenu,
            ]
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>
<?= \bluezed\scrollTop\ScrollTop::widget() ?>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Flowertree <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
