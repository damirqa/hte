<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\project */
/* @var $models app\models\offer */
/* @var $project_id app\models\project */
/* @var $author app\models\profile */
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
    <?php
        if (Yii::$app->getUser()->getIsGuest() && Yii::$app->getUser() != $author) $this->redirect(['../site/login']);
    ?>

    <div class=”offers-to-project”>
        <div class=”offers-to-project-header”><h1>Предложения к проекту</h1></div>
        <?php foreach ($models as $model) { ?>
            <div class=”offer”>
                <div class=”offer-text”><?= $model->text ?></div>
                <div class=”offer-bid”><?= $model->bid ?></div>    <div class=”offer-price”><?= $offer->price?></div>
                <a class=”a-btn” href=”../profile/view?id=<?= $model->performer_id ?>>Профиль исполнителя</a>
                <a class=”a-btn” href=”../offer/accept?project_id=<?= $project_id ?>&offer_id=<?= $model->id ?>”>Принять предложение</a>
            </div>
        <?php } ?>
    </div>
</div>
