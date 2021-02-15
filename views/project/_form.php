<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([
            ' ' => 'Выберите необходимое',
            'Водоснабжение и водоотведение' => 'Водоснабжение и водоотведение',
            'Машиностроение' => 'Машиностроение',
            'Разработка сметной документации' => 'Разработка сметной документации',
            'Строительные конструкции' => 'Строительные конструкции',
            'Транспортные объекты' => 'Транспортные объекты',
            'Имитационное моделирование' => 'Имитационное моделирование',
            'Проектирование объектов' => 'Проектирование объектов',
            'Светотехника' => 'Светотехника',
            'Теплоснабжение/Отопление/Вентиляция' => 'Теплоснабжение/Отопление/Вентиляция',
            'Чертежи/Схемы' => 'Чертежи/Схемы',
            'Инженерные изыскания' => 'Инженерные изыскания',
            'Промышленное и гражданское строительство' => 'Промышленное и гражданское строительство',
            'Слаботочные системы' => 'Слаботочные системы',
            'Техническое обследование и обмеры' => 'Техническое обследование и обмеры',
            'Электроснабжение' => 'Электроснабжение',
        ],
        ['options' => [' ' => ['Selected' => true, 'Disabled' => true]]]) ?>

    <?= $form->field($model, 'annotation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'task_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'on_time')->textInput() ?>

    <?= $form->field($model, 'planned_execution_time')->textInput() ?>

    <?= $form->field($model, 'actual_execution_time')->textInput() ?>

    <?= $form->field($model, 'urgently')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
