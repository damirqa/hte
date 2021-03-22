<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\project */
/* @var $offer app\models\offer */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $view app\views\offer\view */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container">
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <div class="project-view">
        <div class="project-view-data project-header">
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
<!--        ЗАЧЕМ ЭТО?-->
        <input type="text" name="project-id" value="5" disabled hidden>

        <?php
            if (!Yii::$app->getUser()->getIsGuest() && $model->customer_id == Yii::$app->getUser()->getId()) {
                echo "<div class='project-control-buttons'>";
                echo Html::a('Посмотреть предложения', ['/offer/offers-to-project', 'project' => $model->id], ['class' => 'a-btn']);
                echo Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'a-btn']);
                echo Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'a-btn',
                    'data' => [
                        'confirm' => 'Вы действительно хотите удалить?',
                        'method' => 'post',
                    ],
                ]);
                echo "</div>";

            }
        ?>
    </div>

<!--    <div class="project-view-add-info">-->
        <?php
            if (Yii::$app->getUser()->getIsGuest()) {
                ?>
                    <div class="unauthorized-info">Если Вы хотите предложить свою кандидатуру, то Вам необходимо <a href="../site/login">авторизоваться</a>
                        или <a href="../site/signup">зарегистрироваться</a>.
                    </div>
                <?php
            }

            if (!Yii::$app->getUser()->getIsGuest() && $model->customer_id != Yii::$app->getUser()->getId()) {
                echo ($offer == null)
                    ? $this->render('/offer/create', ['model' => new \app\models\Offer(), 'project_id' => $model->id, 'performer' => Yii::$app->getUser()->getId()])
                    : $this->render('/offer/view', ['model' => $offer]) ;
            }

        ?>



<!--        --><?php // echo $this->render('@app/views/offer/_search', ['model' => $searchModel]); ?>
<!--        --><?//= GridView::widget([
//            'dataProvider' => $dataProvider,
//            'columns' => [
//                ['class' => 'yii\grid\SerialColumn'],
//                'id',
//                'project_id',
//                'performer_id',
//                'bid',
//                'date',
//                //'date',
//                //'price',
//                //'customer_id',
//                //'performer_id',
//                //'task_status',
//                //'on_time:datetime',
//                //'planned_execution_time',
//                //'actual_execution_time',
//                //'urgently',
//
//                ['class' => 'yii\grid\ActionColumn', 'template' => '{view}',],
//            ],
//
//        ]); ?>
<!--    </div>-->
</div>
