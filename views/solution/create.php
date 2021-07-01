<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Solution */
/* @var $id_project app\models\Project */
/* @var $id_performer app\models\Performer */

$this->title = 'Create Solution';
$this->params['breadcrumbs'][] = ['label' => 'Solutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solution-create">

    <div class="solution-create-data offer-create-header">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
        'id_project' => $id_project,
        'id_performer' => $id_performer
    ]) ?>

</div>
