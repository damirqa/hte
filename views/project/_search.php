<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-search" style="display: none">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'annotation') ?>

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
    ]) ?>



    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'performer_id') ?>

    <?php  echo $form->field($model, 'task_status')->dropDownList([
            'В процессе' => 'В процессе',
            'В архиве' => 'В архиве',
            'Закрыт' => 'Закрыт',
            'Открыт' => 'Открыт',
            'Решен' => 'Решен'
    ],
    ['options' => ['Открыт' => ['Selected' => true]]]) ?>

    <?php // echo $form->field($model, 'on_time') ?>

    <?php // echo $form->field($model, 'planned_execution_time') ?>

    <?php // echo $form->field($model, 'actual_execution_time') ?>

    <?php // echo $form->field($model, 'urgently') ?>

    <div class="form-group project-filter-control-buttons">
        <?= Html::submitButton('Search', ['class' => 'a-btn']) ?>
        <?= Html::resetButton('Reset', ['class' => 'a-btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
