<?php

namespace app\models;

use Yii;
use mdm\admin\models\form\Login;

class LoginForm extends Login
{
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня'
        ];
    }

}
