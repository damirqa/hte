<?php
    /* @var $offer \app\models\Offer */
?>

<?php
    if (!Yii::$app->getUser()->getIsGuest()) {
        if ($count == 0) {
            ?>
                <div class="project-offers-count project-offers-zero">
                    У вас нет предложений
                </div>
            <?php
        }

        if (is_null($offer) && $count != 0) {
            ?>
                <div class="project-offers-count project-offers-not-accept">
                    Количество предложений: <?= $count ?>, но Вы всё еще не приняли ни одного предложения... <a href="/project/offers?id=<?= $model->id ?>">Посмотреть?</a>
                </div>
            <?php
        }

        if (!is_null($offer)) {
            ?>
            <div class="project-offer-accept">Количество предложений: <?= $count ?>, хотите <a href="/project/offers?id=<?= $model->id ?>">посмотреть?</a></div>

            <div class="project-offers-count project-offer-accept">
                    <div class="project-offer-accept-data">
                        Вы приняли следующее предложение от <a href="/profile/view?id=<?= $performer->id ?>">
                            <?php
                            echo ($performer->surname != '' || $performer->name != '')
                                ? $performer->surname . ' ' . $performer->name
                                : explode('@', $performer->email)[0]
                            ?></a>
                    </div>
                    <div class="project-offer-accept-data">Описание: <?= $offer->text ?></div>
                    <div class="project-offer-accept-data">Дата выполнения: <?= date_format(new DateTime($offer->date), 'd.m.Y') ?></div>
                    <div class="project-offer-accept-data">Цена: <?= $offer->bid ?> ₽</div>
                    <div class="project-offer-accept-data">Вы можете отказаться от данного предложения. <a href="#">Отказаться?</a></div>
                </div>
            <?php
        }

    }
?>