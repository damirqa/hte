<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */
/* @var $project_id integer */
/* @var $performer integer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offer-form">
    <?php $form = ActiveForm::begin([
            'action' => '/offer/create',
            'fieldConfig' => [
                'options' => [
                    'class' => 'offer-create-data',
                ],
            ],
    ]); ?>

    <?= $form->field($model, 'id_project')->hiddenInput(['value' => $project_id])->label(false) ?>

    <?= $form->field($model, 'performer_id')->hiddenInput(['value' => $performer])->label(false) ?>

    <?= $form->field($model, 'text')->textarea() ?>

    <?= $form->field($model, 'scheduled_time_performer')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'bid')->textInput() ?>

    <div class="offer-create-data form-group">
        <?= Html::submitButton('Отправить', ['class' => 'a-btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
