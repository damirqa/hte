<?php
    /* @var $offer \app\models\Offer */
    /* @var $model \app\models\Project */
    /* @var $performer \app\models\Profile */
?>

<?php
    /*
     * Выводим информацию о проекте для владельца задачи
     */
    if (Yii::$app->getUser()->getId() == $model->customer_id) {

        /*
         * Если количество предложений ноль, то сообщаем об этом
         */
        if ($count == 0) {
            ?>
                <div class="project-offers-count project-offers-zero">
                    У вас нет предложений
                </div>
            <?php
        }

        /*
         * Если количество предложений БОЛЬШЕ нуля и предложение ПРИНЯТИ,
         * то выводим количество предложений и просим посмотреть все предложения
         */
        if (is_null($offer) && $count > 0) {
            ?>
                <div class="project-offers-count project-offers-not-accept">
                    Количество предложений: <?= $count ?>, но Вы всё еще не приняли ни одного предложения... <a href="/project/offers?id=<?= $model->id ?>">Посмотреть?</a>
                </div>
            <?php
        }

        /*
         * Если предложение принято,
         * то выводим сообщение, в котором сообщается чьё предложение мы приняли
         * и выводим информацию об предложении
         */
        if (!is_null($offer)) {
            ?>
            <div class="project-offers-count project-offers-zero">Количество предложений: <?= $count ?>, хотите <a href="/project/offers?id=<?= $model->id ?>">посмотреть?</a></div>

            <div class="project-offer-accept">
                Вы приняли следующее предложение от <a href="/profile/view?id=<?= $performer->id ?>">
                <?php
                    echo ($performer->surname != '' || $performer->name != '')
                        ? $performer->surname . ' ' . $performer->name
                        : explode('@', $performer->email)[0]
                ?></a>
            </div>

            <div class="project-offers-count project-offer-accept">
                    <div class="project-offer-accept-data">Описание: <?= $offer->text ?></div>
                    <div class="project-offer-accept-data">Дата выполнения: <?= date_format(new DateTime($offer->date), 'd.m.Y') ?></div>
                    <div class="project-offer-accept-data">Цена: <?php  echo is_null($offer->bid) ? 'Договорная' : $offer->bid . ' руб.' ?></div>
                    <div class="project-offer-accept-data">Вы можете отказаться от данного предложения. <a href="#">Отказаться?</a></div>
                </div>
            <?php
        }

    }
?>