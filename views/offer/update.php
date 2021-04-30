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
    <div class="container">
        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'options' => [
                    'class' => 'offer-create-data',
                ],
            ],
        ]); ?>

        <?= $form->field($model, 'project_id')->hiddenInput(['value' => $project_id])->label(false) ?>

        <?= $form->field($model, 'performer_id')->hiddenInput(['value' => $performer])->label(false) ?>



        <div class="row">
            <div class="col"><?= $form->field($model, 'text')->textarea() ?></div>
        </div>
        <div class="row">
            <div class="col">
                <?= $form->field($model, 'scheduled_time_performer')->textInput(['type'=>'date']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= $form->field($model, 'bid')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="offer-create-data form-group">
                    <?= Html::submitButton('Обновить', ['class' => 'a-btn']) ?>
                </div>
            </div>
        </div>



        <?php ActiveForm::end(); ?>
    </div>
</div>
