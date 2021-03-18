<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $projects yii\model\Project*/

$this->title = 'Проекты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="project-index">

<!--        <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

        <?php
            if (Yii::$app->getUser()->getIsGuest()) {
                ?>
                    <p>Если вы хотите создать проект, то Вам необходимо <a href="../site/login">авторизоваться</a>
                    или <a href="../site/signup">зарегистрироваться</a>.</p>
                <?php
            }
        ?>
<!--    class: project-control-buttons-->
        <div class="">
            <?php
                if (!Yii::$app->getUser()->getIsGuest()) {
                    ?>
                        <?= Html::a('Создать проект', ['create'], ['class' => 'a-btn']) ?>
                    <?php
                }
            ?>
<!--            <a class="a-btn search">Фильтр</a>-->
        </div>

            <div class="list-projects">
                <div class="list-project"><h1>Лента задач</h1></div>
                <?php
                    foreach ($projects as $project) {
                ?>
                <div class="list-project">
                    <a href="../project/view?id=<?= $project->id ?>">
                    <div class="list-project-header">
                        <?= $project->title ?>
                    </div>
                    <div class="list-project-type">
                        <strong>Тип работ:</strong> <?= $project->type ?>; <strong>Цена:</strong> <?= $project->price == "" ? "Договорная" : $project->price ?>
                    </div>
                    <div class="list-project-annotation">
                        <p> <?= $project->annotation ?></p>
                    </div>
                    </a>
                </div>
                <?php
                    }
                ?>
                <div class="list-project">Пагинация</div>
            </div>


<!--        --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--            --><?//= GridView::widget([
//                'dataProvider' => $dataProvider,
//                'columns' => [
//                    ['class' => 'yii\grid\SerialColumn'],
//                    //'id',
//                    'title',
//                    'type',
//                    'annotation',
//                    //'description:ntext',
//                    //'date',
//                    //'price',
//                    //'customer_id',
//                    //'performer_id',
//                    //'task_status',
//                    //'on_time:datetime',
//                    //'planned_execution_time',
//                    //'actual_execution_time',
//                    //'urgently',
//
//                    ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}',],
//                ],
//
//            ]);
//
////            echo '<pre>';
////            var_dump($dataProvider);
////            print_r($array);
////            echo '</pre>';?>

    </div>

</div>