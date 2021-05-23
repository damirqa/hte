<?php
use app\models\Profile;

/* @var $role string Role of user*/

if ($model->photo_link == NULL) {
    $photo = ($model->gender == "Мужской") ? "../img/user-male.png" : "../img/user-female.png";
}
else {
    $photo = $model->photo_link;
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-avatar">
                <img src="<?= $photo ?>">
            </div>
        </div>
        <div class="col-md-8">
            <?php
                if ($model->id == Yii::$app->getUser()->getId()) echo $this->render('_form', ['model' => $model]);
            ?>
        </div>
    </div>
</div>
