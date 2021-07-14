<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\project */
/* @var $offer app\models\offer */
/* @var $offers app\models\offer */
/* @var $solution app\models\solution */
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
            Файлы проект: <br>
            <?php
                $links = explode(';', $model->files_link);

                for ($i = 0; $i < count($links) - 1; $i++) {
                    $ext = explode('.', $links[$i]);
                    $file = explode('/', $links[$i]);

                    echo '<a href="../'. $links[$i] .'"><div class="file-' . array_pop($ext) .
                        '" title="' . array_pop($file) . '"></div></a>';
                }
            ?>
        </div>

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

    <?=
        $this->render('@app/views/offer/_count.php', [
                'model' => $model,
                'offer' => $offer,
                'count' => $count,
                'performer' => $performer]);
    ?>

        <?php
            /*
             * Если пользователь является гостем, то необходимо показать ТОЛЬКО форму авторизации
             */
            if (Yii::$app->getUser()->getIsGuest()) {
                ?>
                    <div class="unauthorized-info">Если Вы хотите предложить свою кандидатуру, то Вам необходимо <a href="../site/login">авторизоваться</a>
                        или <a href="../site/signup">зарегистрироваться</a>.
                    </div>
                <?php
            }

            /*
             * Если пользователь НЕ гость и НЕ является владельцем проекта
             */
            if (!Yii::$app->getUser()->getIsGuest() && $model->customer_id != Yii::$app->getUser()->getId()) {

                /*
                 * Если предложение отсутствует, то выводим форму предложения решения
                 * Иначе мы показываем решение
                 */
                echo ($offer == null)
                    ? $this->render('/offer/create', ['model' => new \app\models\Offer(), 'project_id' => $model->id, 'performer' => Yii::$app->getUser()->getId()])
                    : $this->render('/offer/view', ['model' => $offer]) ;

                /*
                 * Если предложение ПРИНЯЛИ, а решение ОТСУТСТВУЕТ,
                 * то необходимо вывести форму СОЗДАНИЯ
                 */
                if ($offer->status == 'Принят' && $solution == null) {
                    echo $this->render('/solution/create', ['model' => new \app\models\Solution(), 'id_project' => $model->id, 'id_performer' => Yii::$app->getUser()->getId()]);
                }
                elseif ($offer->status == 'Принят' && $solution != null){
                    $this->render('/solution/view', ['model' => $solution]);
                }
            }

        ?>
</div>
<script>
    var editOffer = $.confirm({
        title: 'Редактирование предложения',
        lazyOpen: true,
        useBootstrap: false,
        boxWidth: '70%',
        buttons: {
            close: {
                text: 'Закрыть'
            }
        }
    });

    $('.btn-update').click(function (e) {
        e.preventDefault();
        editOffer.content = 'url:' + $(this).attr('href');
        editOffer.open();
    });
    $(document).ready(function () {

    });
</script>