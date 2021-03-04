<?php


namespace app\models;

use mdm\admin\components\Configs;
use mdm\admin\components\UserStatus;
use mdm\admin\models\form\Signup as SignupForm;
use Yii;
use yii\helpers\ArrayHelper;

class Signup extends SignupForm
{
    public $role;

    public function rules()
    {
        $class = Yii::$app->getUser()->identityClass ? : 'mdm\admin\models\User';
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => $class, 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => $class, 'message' => 'This email address has already been taken.'],

            ['role', 'required'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['retypePassword', 'required'],
            ['retypePassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $class = Yii::$app->getUser()->identityClass ? : 'mdm\admin\models\User';
            $user = new $class();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = ArrayHelper::getValue(Yii::$app->params, 'user.defaultStatus', UserStatus::ACTIVE);
            $user->setPassword($this->password);
            $user->generateAuthKey();

            if ($user->save()) {
                $manager = Configs::authManager();
                $item = $manager->getRole($this->role);
                $item = $item ?: $manager->getPermission($this->role);
                $id = $user->id;

                try {
                    if ($this->role == "Customer") {
                        $manager->assign($item, $id);
                    }
                    else if ($this->role == "Performer") {
                        $manager->assign($item, $id);
                    }
                } catch (\Exception $exception) {
                    echo "Ошибка при выдаче прав пользователя";
                }
                return $user;
            }
        }
        return null;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'retypePassword' => 'Повторите пароль',
            'email' => 'Электронная почта',
            'role' => 'Роль'
        ];
    }
}