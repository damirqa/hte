<?php
use app\models\Profile;

/* @var $role string Role of user*/

$photo       = $model->photo_link;
$surname     = ($model->surname == NULL)    ? "не заполнено" : $model->surname;
$name        = ($model->name == NULL)       ? "не заполнено" : $model->name;
$gender      = $model->gender;
$birthday    = ($model->birthday == NULL)   ? ""             : "День рождения: " . date_format(new DateTime($model->birthday), 'd.m.Y');
$telephone   = ($model->telephone == NULL)  ? ""             : "Телефон: " . $model->telephone;
$email       = ($model->email == NULL)      ? ""             : $model->email;
$site        = ($model->site == NULL)       ? ""             : "Сайт: " . $model->site;
$company     = ($model->company == NULL)    ? ""             : "Компания" . $model->company;
$city        = ($model->city == NULL)       ? ""             : "Город: " . $model->city;
$about       = ($model->about == NULL)      ? "не заполнено" : $model->about;

if ($photo == NULL) {
    $photo = ($model->gender == "Мужской") ? "../img/user-male.png" : "../img/user-female.png";
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-avatar">
                <img src="<?= $photo ?>">
            </div>
        </div>
<!--        <div class="col-md-4 place-for-user-info">-->
<!--            <div class="user-info">-->
<!--                <div class="profile-data user-photo"><img src="--><?//=$photo?><!--" alt="user-photo"></div>-->
<!--                <div class="profile-data">Фамилия: --><?//=$surname?><!--</div>-->
<!--                <div class="profile-data">Имя: --><?//=$surname?><!--</div>-->
<!--                <div class="profile-data">Пол: --><?//=$gender?><!--</div>-->
<!--                <div class="profile-data">--><?//=$birthday?><!--</div>-->
<!--                <div class="profile-data">--><?//=$telephone?><!--</div>-->
<!--                <div class="profile-data">Почта: --><?//=$email?><!--</div>-->
<!--                <div class="profile-data">Статус: --><?//=$model->role?><!--</div>-->
<!--                <div class="profile-data">--><?//=$company?><!--</div>-->
<!--                <div class="profile-data">--><?//=$city?><!--</div>-->
<!--                <div class="profile-data">О себе: --><?//=$about?><!--</div>-->
<!--                <a class="profile-data a-btn" href="/profile/update">Редактировать</a>-->
<!--            </div>-->
<!--        </div>-->
        <div class="col-md-8">

            <?php
                if ($model->id == Yii::$app->getUser()->getId()) echo $this->render('_form', ['model' => $model]);
            ?>
        </div>
    </div>
</div>
