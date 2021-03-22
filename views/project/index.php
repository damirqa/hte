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
        <?php
            if (Yii::$app->getUser()->getIsGuest()) {
                ?>
                    <p>Если вы хотите создать проект, то Вам необходимо <a href="../site/login">авторизоваться</a>
                    или <a href="../site/signup">зарегистрироваться</a>.</p>
                <?php
            }
        ?>
<!--    class: project-control-buttons-->
<!--        <div class="">-->
<!--            --><?php
//                if (!Yii::$app->getUser()->getIsGuest()) {
//                    ?>
<!--                        --><?//= Html::a('Создать проект', ['create'], ['class' => 'a-btn']) ?>
<!--                    --><?php
//                }
//            ?>


<!--        --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>


        <div class="row">
            <div class="col-md-9">
                <div class="project-search-table">
                    <div class="project-search-table-header">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-2">Заголовок</div>
                                <div class="col-sm-3">Тип работ</div>
                                <div class="col-sm-2">Дата</div>
                                <div class="col-sm-1">Статус</div>
                                <div class="col-sm-4">Аннотация</div>
                            </div>
                        </div>
                    </div>
                    <div class="project-search-table-body">
                        <div class="container-fluid">
                            <?php
                                foreach ($projects as $project) {

                                    echo "<div class='row'>";
                                    echo "<a class='project-data-row' href='../project/view?id=" . $project->id . "'>";
                                    echo "<div class='col-sm-2'>" . $project->title       . "</div>";
                                    echo "<div class='col-sm-3'>" . $project->type        . "</div>";
                                    echo "<div class='col-sm-2'>" . $project->date        . "</div>";
                                    echo "<div class='col-sm-1'>" . $project->task_status . "</div>";
                                    echo "<div class='col-sm-4'>" . $project->annotation  . "</div>";
                                    echo "</a>";
                                    echo "</div>";

                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="project-search-filter">
                    <div class="project-search-filter-header">Фильтр</div>
                    <div class="project-search-filter-body">
                        <form>
                            <input class="project-search-filter-input" type="text" placeholder="Название">
                            <input class="project-search-filter-input" type="text" placeholder="Тип работ">
                            <input class="project-search-filter-input" type="text" placeholder="Дата создания">
                            <input class="project-search-filter-input" type="text" placeholder="Статус задачи">
                            <div class="buttons-control-filter">
                                <a class="btn-control-filer btn-search">Найти</a>
                                <a class="btn-control-filer btn-clear">Очистить</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="create-project">
                    <a class="a-btn reverse-color" href="../project/create">Создать проект</a>
                </div>
            </div>
        </div>

    </div>

</div>