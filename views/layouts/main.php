<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
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
            //'class' => 'navbar navbar-inverse',
            'class' => 'navbar navbar-expand-lg navbar-light bg-light'
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Проекты', 'url' => ['/project/index']],
            ['label' => 'Избранное', 'url' => ['/site/index']],
            ['label' => 'Мои работы', 'url' => ['/site/index']],
            ['label' => 'Информация', 'url' => ['/site/index']],
            ['label' => 'Профиль', 'url' => ['profile/index'], 'visible' => !Yii::$app->user->isGuest],

//            ['label' => 'Главная страница', 'url' => ['/site/index']],
//            ['label' => 'Схема взаимодействия', 'url' => ['/site/scheme']],
//            ['label' => 'Карьера', 'url' => ['/site/career']],
//            ['label' => 'Контакты', 'url' => ['/site/contact']],
//            ['label' => 'Проекты', 'url' => ['/project/index']],
//            ['label' => 'Мои профиль', 'url' => ['profile/index'], 'visible' => !Yii::$app->user->isGuest],

            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login'], 'options' => ['class' => 'button']]
            ) : (
                ['label' => 'Выйти', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]
            )
        ],
    ]);
    NavBar::end();
    ?>

    <?= $content ?>
<footer class="footer">
    <div class="container">
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
