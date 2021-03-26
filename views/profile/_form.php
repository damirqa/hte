<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(['action' => '/profile/update','options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="profile-row-data">
        <?= $form->field($model, 'surname')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'placeholder' => 'Ваша фамилия', 'class' => 'profile-item-data']) ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'placeholder' => 'Ваше имя', 'class' => 'profile-item-data']) ?>
    </div>

    <div class="profile-row-data">
        <?= $form->field($model, 'birthday')->textInput(['maxlength' => true, 'type' => date, 'autocomplete' => 'off', 'class' => 'profile-item-data']) ?>
        <?= $form->field($model, 'gender')->dropDownList(['Мужской' => 'Мужской', 'Женский' => 'Женский'], ['autocomplete' => 'off', 'class' => 'profile-item-data']) ?>
    </div>

    <div class="profile-row-data">
        <?= $form->field($model, 'telephone')->textInput(['maxlength' => 16, 'type' => 'tel', 'placeholder' => '+7 (123) 456-78-89', 'autocomplete' => 'off', 'class' => 'profile-item-data']) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'class' => 'profile-item-data']) ?>
    </div>

    <div class="profile-row-data">
        <?= $form->field($model, 'company')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'class' => 'profile-item-data']) ?>
        <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'class' => 'profile-item-data']) ?>
    </div>

    <div class="profile-row-data">
        <?= $form->field($model, 'about')->textarea(['rows' => 6, 'autocomplete' => 'off', 'class' => 'profile-item-data']) ?>
    </div>

<!--    --><?//= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>
<!--    -->
<!--    --><?//= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="profile-row-data">
        <?= Html::submitButton('Сохранить', ['class' => 'a-btn']) ?>
    </div>

    <div class="form-group">
    </div>

    <?php ActiveForm::end(); ?>

</div>
