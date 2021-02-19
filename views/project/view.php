<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container">
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?php
    if (Yii::$app->getUser()->getId() == $model->customer_id)  {
        echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        echo Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]);
    }
    ?>

    <div class="project-view">
        <div class="project-view-data">
            <h1><?= Html::encode($this->title)?></h1>
        </div>

        <div class="project-view-data">
            Тип работы: <?= $model->type ?>
        </div>

        <div class="project-view-data">
            Дата создания: <?= date_format(new DateTime($model->date), 'd.m.Y')?>
        </div>

        <div class="project-view-data">
            Статус задачи: <?= $model->task_status?>
        </div>

        <div class="project-view-data">
            <div>Описание:</div>
            <?= $model->description ?>
        </div>

        <div></div>

        <div class="project-view-data">
            Цена: <?php echo $model->price == NULL ? 'Договорная' : $model->price?>
        </div>

        <div class="project-view-data">
            Файлы доступны после одобрения
        </div>



<!--        --><?//= DetailView::widget([
//            'model' => $model,
//            'attributes' => [
//                'id',
//                'title',
//                'type',
//                'annotation',
//                'description:ntext',
//                'date',
//                'price',
//                'customer_id',
//                'performer_id',
//                'task_status',
//                'on_time',
//                'planned_execution_time',
//                'actual_execution_time',
//                'urgently',
//            ],
//        ]) ?>

    </div>

    <?php
        if ($model->task_status == "Открыт" && !Yii::$app->getUser()->getIsGuest() && $model->customer_id != Yii::$app->getUser()->getId())
        {
            ?>
            <div class="proposal">
                <div><input type="text"></div>
                <input type="text"> <input type="submit">
            </div>
            <?php
        }
    ?>
</div>
