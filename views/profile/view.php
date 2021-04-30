<?php
use app\models\Profile;

/* @var $role string Role of user*/

if ($model->photo_link == NULL) {
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
        <div class="col-md-8 profile-data-user">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="data-label">Фамилия</div>
                        <div class="place-data"><?= $model->surname ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="data-label">Имя</div>
                        <div class="place-data"><?= $model->name ?></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="data-label">День рождения</div>
                        <div class="place-data"><?= date_format(new DateTime($model->birthday), "d.m.Y") ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="data-label">Пол</div>
                        <div class="place-data"><?= $model->gender ?></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="data-label">Телефон</div>
                        <div class="place-data"><?= $model->telephone ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="data-label">Электонная почта</div>
                        <div class="place-data"><?= $model->email ?></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="data-label">Компания</div>
                        <div class="place-data"><?= $model->company ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="data-label">Город</div>
                        <div class="place-data"><?= $model->city ?></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="data-label">О себе</div>
                        <div class="place-data about"><?= $model->about ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
