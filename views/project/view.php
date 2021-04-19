<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\project */
/* @var $offer app\models\offer */
/* @var $offers app\models\offer */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $view app\views\offer\view */
/* @var $performer \app\models\Profile*/


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
            Цена: <?php echo $model->price == NULL ? 'Договорная' : $model->price . " ₽"?>
        </div>

        <div class="project-view-data">
            Файлы доступны после одобрения
        </div>
<!--        ЗАЧЕМ ЭТО?-->
        <input type="text" name="project-id" value="5" disabled hidden>


        <?php
            if (!Yii::$app->getUser()->getIsGuest() && $model->customer_id == Yii::$app->getUser()->getId()) {
                echo "<div class='project-control-buttons'>";
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

    <?php
        if (is_null($offer) && $count == 0 && Yii::$app->getUser()->getId() == $model->customer_id) {
            ?>
                <div class="project-offers-count project-offers-zero">
                    У вас нет предложений
                </div>
            <?php
        }
    ?>

    <?php
        if (is_null($offer) && $count != 0 && Yii::$app->getUser()->getId() == $model->customer_id) {
            ?>
                <div class="project-offers-count project-offers-not-accept">
                    Количество предложений: <?= $count ?>, но Вы всё еще не приняли ни одного предложения... <a href="/project/offers?id=<?= $model->id ?>">Посмотреть?</a>
                </div>
            <?php
        }
    ?>

    <?php
        if (!is_null($offer) && Yii::$app->getUser()->getId() == $model->customer_id) {
            ?>
                <div class="project-offers-count project-offer-accept">
                    <div class="project-offer-accept-data">Количество предложений: <?= $count ?>, хотите <a href="/project/offers?id=<?= $model->id ?>">посмотреть?</a></div>
                    <div class="project-offer-accept-data">
                        Вы приняли следующее предложение от <a href="/profile/view?id=<?= $performer->id ?>"><?= $performer->surname ?> <?= $performer->name ?></a>:
                    </div>
                    <div class="project-offer-accept-data">Описание: <?= $offer->text ?></div>
                    <div class="project-offer-accept-data">Дата выполнения: <?= date_format(new DateTime($offer->date), 'd.m.Y') ?></div>
                    <div class="project-offer-accept-data">Цена: <?= $offer->bid ?> ₽</div>
                    <div class="project-offer-accept-data">Вы можете отказаться от данного предложения. <a href="#">Отказаться?</a></div>
                </div>
            <?php
        }
    ?>


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
</div>
