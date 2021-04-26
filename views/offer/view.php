<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */

$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="offer-view">

    <div class="offer-view-data offer-view-header"><h1>Ваше предложение</h1></div>
    <div class="offer-view-data">
        <div>Описание:</div>
        <?= $model->text ?>
    </div>
    <div class="offer-view-data">Дата выполнения: <?= date_format(new DateTime($model->date), "d.m.Y") ?></div>
    <div class="offer-view-data">Цена: <?= $model->bid?> руб.</div>
    <div class="offer-view-data offer-control-buttons">
        <?= Html::a('Обновить', ['/offer/update', 'id' => $model->id], ['class' => 'a-btn']) ?>
        <?= Html::a('Удалить', ['/offer/delete', 'id' => $model->id], [
            'class' => 'a-btn',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
</div>

