<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php
NavBar::begin([
    //'innerContainerOptions' => ['class' => 'container-fluid'],
    'brandLabel' => Html::img('@web/img/logo.svg', ['alt'=>Yii::$app->name, 'class' => 'logo']),
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse',
    ],
]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => [
        ['label' => 'Главная страница', 'url' => ['/site/index']],
        ['label' => 'Схема взаимодействия', 'url' => ['/site/scheme']],
        ['label' => 'Карьера', 'url' => ['/site/career']],
        ['label' => 'Контакты', 'url' => ['/site/contacts']],
        ['label' => 'Мои данные', 'url' => ['site/profile'], 'visible' => !Yii::$app->user->isGuest],
        ['label' => 'Все пользователи', 'url' => ['/rbac/default/index']],
        ['label' => 'Все задачи', 'url' => ['/site/contacts']],

        Yii::$app->user->isGuest ? (
        ['label' => 'Войти', 'url' => ['/site/login'], 'options' => ['class' => 'button']]
        ) : (
        ['label' => 'Выйти', 'url' => ['/site/logout', 'post'], 'linkOptions' => ['data-method' => 'post']]
        )
    ],
]);
NavBar::end();
?>

<!--    <div class="container-fluid">-->
<!--        --><?//= Breadcrumbs::widget([
//            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//        ]) ?>
<!--        --><?//= Alert::widget() ?>
<!--        --><?//= $content ?>
<!--    </div>-->
<?= $content ?>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>