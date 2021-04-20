<?php
/* @var $customer integer*/
$this->title = 'Предложения к проекту: ' . $model->title;
?>

<div class="container">
    <?php
        if (Yii::$app->getUser()->getIsGuest() && Yii::$app->getUser()->getId() != $customer)
            $this->redirect(['../site/login'])
    ?>

    <h1><?= $this->title?></h1>

    <div class="offers-to-project">
        <table id="table">
            <thead>
            <tr>
                <th data-field="performer">Исполнитель</th>
                <th data-field="text">Предложение</th>
                <th data-field="date">Дата</th>
                <th data-field="bid" data-formatter="currencyFormatter">Цена</th>
                <th data-field="date-exec">Дата выполнения</th>
                <th data-field="id" data-align="center" data-formatter="linkFormatter">Действия</th>
            </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    var $table = $('#table')

    $table.bootstrapTable({
        url: '/project/get-offers-json?id=<?= $model->id ?>'

    });

    function linkFormatter(value, field, index, row) {
        return "<a title='Отметить, что просмотрено' href='/project/see?p=<?= $model->id ?>&c=<?= $customer?>&o="+value+"'>"+"<i class=\"fas fa-eye\"></i> "+"</a>"
            + "<a title='Принять' href='/project/accept?p=<?= $model->id ?>&c=<?= $customer?>&o="+value+"'>"+"<i class=\"fas fa-check-circle\"></i> "+"</a>"
            + "<a title='Отклонить' href='/project/decline?p=<?= $model->id ?>&c=<?= $customer?>&o="+value+"'>"+"<i class=\"fas fa-times-circle\"></i> "+"</a>";
    }

    function currencyFormatter(value) {
        return (value == "Договорная") ? "Договорная" : value + " ₽";
    }
</script>
