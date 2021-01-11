<?php

namespace app\controllers;

use Yii;

class ProfileController extends \yii\web\Controller
{

    public function actionUser()
    {
        $model = Yii::$app->getUser()->id;
        var_dump($model);
        return $this->render('profile');
    }

}