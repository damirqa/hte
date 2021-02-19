<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="project-index">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php
            if (!Yii::$app->getUser()->getIsGuest()) {
                ?>
                    <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
                <?php
            }
        ?>
        <button class="btn btn-warning search">Фильтр</button>


        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id',
                    'title',
                    'type',
                    'annotation',
                    'description:ntext',
                    //'date',
                    //'price',
                    //'customer_id',
                    //'performer_id',
                    //'task_status',
                    //'on_time:datetime',
                    //'planned_execution_time',
                    //'actual_execution_time',
                    //'urgently',

                    ['class' => 'yii\grid\ActionColumn', 'template' => '{view}',],
                ],

            ]); ?>


    </div>

</div>