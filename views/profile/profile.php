<?php
use app\models\Profile;


var_dump($model);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="user_info">
                <div class="user_photo"><img src="<?=$model->photo_link ?>" alt=""></div>
                <div><?php echo ($model->surname == NULL)   ? "Отсутствует фамилия"           : $model->surname ?></div>
                <div><?php echo ($model->name == NULL)      ? "Отсутствует имя"               : $model->name    ?></div>
                <div><?php echo ($model->gender == "MAN")   ? "Мужской"                       : "Женский"       ?></div>
                <div><?php echo ($model->birthday == NULL)  ? "Отсутствует дата рождения"     : $model->birthday ?></div>
                <div><?php echo ($model->telephone == NULL) ? "Отсутствует номер телефона"    : $model->telephone ?></div>
                <div><?php echo ($model->email == NULL)     ? "Отсутствует почта"             : $model->email?></div>
                <div><?php echo ($model->site == NULL)      ? "Отсутствует ссылка на сайт"    : $model->site ?></div>
                <div><?php echo ($model->role == NULL)      ? "Вы не выбрали роль"            : $model->role?></div>
                <div><?php echo ($model->company == NULL)   ? "Отсутствует название компании" : $model->company?></div>
                <div><?php echo ($model->city == NULL)      ? "Отсутствует название города"   : $model->city?></div>
                <div><?php echo ($model->about == NULL)     ? "Отсутствует биография"  : $model->about?></div>
            </div>
        </div>
        <div class="col-md-8"></div>
    </div>
</div>
