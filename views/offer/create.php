<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Offer */
/* @var $project_id integer */
/* @var $performer integer */

$this->title = 'Предложить решение';
$this->params['breadcrumbs'][] = ['label' => 'Offers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="offer-create">

        <div class="offer-create-data offer-create-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <?= $this->render('_form', [
            'model' => $model,
            'project_id' => $project_id,
            'performer' => $performer
        ]) ?>

    </div>
