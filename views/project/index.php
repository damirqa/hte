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
<!--    <div class="project-index">-->
<!--        --><?php
//            if (Yii::$app->getUser()->getIsGuest()) {
//                ?>
<!--                    <p>Если вы хотите создать проект, то Вам необходимо <a href="../site/login">авторизоваться</a>-->
<!--                    или <a href="../site/signup">зарегистрироваться</a>.</p>-->
<!--                --><?php
//            }
//        ?>
<!--        <div class="row">-->
<!--            <div class="col-md-9">-->
<!--                <div class="project-search-table">-->
<!--                    <div class="project-search-table-header">-->
<!--                        <div class="container-fluid">-->
<!--                            <div class="row">-->
<!--                                <div class="col-sm-2">Заголовок</div>-->
<!--                                <div class="col-sm-3">Тип работ</div>-->
<!--                                <div class="col-sm-2">Дата</div>-->
<!--                                <div class="col-sm-1">Статус</div>-->
<!--                                <div class="col-sm-4">Аннотация</div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="project-search-table-body">-->
<!--                        <div class="container-fluid">-->
<!--                            --><?php
//                                foreach ($projects as $project) {
//
//                                    echo "<div class='row'>";
//                                    echo "<a class='project-data-row' href='../project/view?id=" . $project->id . "'>";
//                                    echo "<div class='col-sm-2'>" . $project->title       . "</div>";
//                                    echo "<div class='col-sm-3'>" . $project->type        . "</div>";
//                                    echo "<div class='col-sm-2'>" . $project->date        . "</div>";
//                                    echo "<div class='col-sm-1'>" . $project->task_status . "</div>";
//                                    echo "<div class='col-sm-4'>" . $project->annotation  . "</div>";
//                                    echo "</a>";
//                                    echo "</div>";
//
//                                }
//                            ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-3">-->
<!--                <div class="project-search-filter">-->
<!--                    <div class="project-search-filter-header">Фильтр</div>-->
<!--                    <div class="project-search-filter-body">-->
<!--                        <form>-->
<!--                            <input class="project-search-filter-input" type="text" placeholder="Название">-->
<!--                            <input class="project-search-filter-input" type="text" placeholder="Тип работ">-->
<!--                            <input class="project-search-filter-input" type="text" placeholder="Дата создания">-->
<!--                            <input class="project-search-filter-input" type="text" placeholder="Статус задачи">-->
<!--                            <div class="buttons-control-filter">-->
<!--                                <a class="btn-control-filer btn-search">Найти</a>-->
<!--                                <a class="btn-control-filer btn-clear">Очистить</a>-->
<!--                            </div>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="create-project">-->
<!--                    <a class="a-btn reverse-color" href="../project/create">Создать проект</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->


<table id="table">
<!--    <thead>-->
<!--        <tr>-->
<!--            <th data-field="title">Заголовок</th>-->
<!--            <th data-field="type">Тип работ</th>-->
<!--            <th data-field="date">Дата</th>-->
<!--            <th data-field="annotation">Аннотация</th>-->
<!--        </tr>-->
<!--    </thead>-->
</table>

<script>
    var $table = $('#table')

    $('#table').bootstrapTable({
        columns: [{
            title: 'ID',
            field: 'title',
        }, {
            title: 'Item Name',
            field: 'type'
        }, {
            title: 'Item Price',
            field: 'date'
        }, {
            title: 'Item Price',
            field: 'annotation'
        }, {
            title: 'Item Price',
            field: 'description'
        }, {
            title: 'Item Price',
            field: 'date'
        }],
        url: '/project/get-json',
        pagination: 'true',
        pageList: [5, 10 , 15],
        search: 'true',
        showRefresh: 'true',
        showFullscreen: 'true',
        advancedSearch: 'true',
        idTable: 'advancedSearch',
        buttons: buttons(),
        icons: {advancedSearchIcon: 'fa-search-plus', refresh: 'fa-sync', fullscreen: 'fa-arrows-alt'},
        buttonsOrder: ['advancedSearch', 'clearAdvancedSearch', 'refresh']

    });

    function buttons () {
        return {
            clearAdvancedSearch: {
                text: 'Очистить расширенный фильтр',
                icon: 'fa-search-minus',
                event: function () {
                    // $('#advancedSearch').trigger('reset');
                    // $table.bootstrapTable('onColumnAdvancedSearch', {})
                    // $table.bootstrapTable('refresh')
                    $table.bootstrapTable('toolbar').initSearch();
                },
                attributes: {
                    title: 'Очистить фильтр'
                }
            },

        }
    }


</script>