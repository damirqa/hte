<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="project-row-data">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'form-control project-item-data']) ?>
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
            ['options' => [' ' => ['Selected' => true, 'Disabled' => true]], 'class' => 'form-control project-item-data']) ?>
    </div>

    <div class="project-row-data">
        <?= $form->field($model, 'annotation')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="project-row-data">
        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    </div>

    <div class="project-row-data">
        <?= $form->field($model, 'planned_execution_time')->textInput(['type' => 'date', 'class' => 'form-control project-item-data']) ?>

        <?= $form->field($model, 'price')->textInput(['class' => 'form-control project-item-data']) ?>
    </div>

    <div class="project-row-data">
        <?= $form->field($model, 'on_time')->radioList(['Да' => 'Да, обязан выполнить вовремя', 'Нет' => 'Нет, допускаются задержки']) ?>
    </div>

    <div class="project-row-data">
        <?= $form->field($model, 'urgently')->radioList(['Да' => 'Да', 'Нет' => 'Нет']) ?>
    </div>

    <div class="project-row-data">
        <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'files/*'])?>
        <?= Html::submitButton('Сохранить проект', ['class' => 'a-btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    $('#project-imagefiles').bind('change', function () {
        let countFiles = '';

        if (this.files && this.files.length >= 1)
            countFiles = this.files.length;

        if (countFiles) {
            $(this).siblings('label').text('Выбрано файлов: ' + countFiles)
        }
    })
</script>