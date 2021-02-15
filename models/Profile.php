<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string|null $surname
 * @property string|null $name
 * @property string|null $email
 * @property string|null $gender
 * @property string|null $birthday
 * @property string|null $telephone
 * @property string|null $site
 * @property string|null $role
 * @property string|null $company
 * @property string|null $about
 * @property string|null $photo_link
 * @property string|null $city
 *
 * @property User $id0
 */
class Profile extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['birthday'], 'safe'],
            [['about', 'photo_link'], 'string'],
            [['surname', 'name', 'email', 'gender', 'telephone', 'site', 'role', 'company', 'city'], 'string', 'max' => 255],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
            [['imageFile'], 'file']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'email' => 'Электронная почта',
            'gender' => 'Пол',
            'birthday' => 'День рождения',
            'telephone' => 'Телефон',
            'site' => 'Сайт',
            'role' => 'Роль',
            'company' => 'Компания',
            'about' => 'О себе',
            'photo_link' => 'Фото профиля',
            'city' => 'Город',
            'imageFile' => "Фото профиля"
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }
}
