<?php
use app\models\Profile;

$photo       = $model->photo_link;
$surname     = ($model->surname == NULL)    ? "не заполнено" : $model->surname;
$name        = ($model->name == NULL)       ? "не заполнено" : $model->name;
$gender      = ($model->gender == "MAN")    ? "мужской"      : "женский";
$birthday    = ($model->birthday == NULL)   ? ""             : "День рождения: " . $model->birthday;
$telephone   = ($model->telephone == NULL)  ? ""             : "Телефон: " . $model->telephone;
$email       = ($model->email == NULL)      ? ""             : $model->email;
$site        = ($model->site == NULL)       ? ""             : "Сайт: " . $model->site;
//$role        = ($role->role == NULL)       ? "Ошибка"       : $model->role;
$company     = ($model->company == NULL)    ? ""             : "Компания" . $model->company;
$city        = ($model->city == NULL)       ? ""             : "Город: " . $model->city;
$about       = ($model->about == NULL)      ? "не заполнено" : $model->about;

if ($photo == NULL) {
    $photo = ($model->gender == "MAN") ? "user-male.png" : "user-female.png";
}

$role = $role == "User" ? "Пользователь" : "Заказчик";
?>
<div class="container">
    <div class="row">
        <div class="col-md-4 place-for-user-info">
            <div class="user-info">
                <div class="profile-data user-photo"><img src="../img/<?=$photo?>" alt="user-photo"></div>
                <div class="profile-data">Фамилия: <?=$surname?></div>
                <div class="profile-data">Имя: <?=$surname?></div>
                <div class="profile-data">Пол: <?=$gender?></div>
                <div class="profile-data"><?=$birthday?></div>
                <div class="profile-data"><?=$telephone?></div>
                <div class="profile-data">Почта: <?=$email?></div>
                <div class="profile-data">Статус: <?=$role?></div>
                <div class="profile-data"><?=$company?></div>
                <div class="profile-data"><?=$city?></div>
                <div class="profile-data">О себе: <?=$about?></div>
                <a class="profile-data a-btn" href="/profile/update">Редактировать</a>
            </div>
        </div>
        <div class="col-md-8"></div>
    </div>
</div>
