<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Solution */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solution-form">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'options'=> [
                'class' => 'solution-create-data'
            ],
        ],
    ]); ?>

    <?= $form->field($model, 'id_project')->textInput() ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <?= $form->field($model, 'date_change')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="solution-create-data form-group">
        <?= Html::submitButton('Save', ['class' => 'a-btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
