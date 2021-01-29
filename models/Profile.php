<?php

namespace app\models;

use Yii;

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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Surname',
            'name' => 'Name',
            'email' => 'Email',
            'gender' => 'Gender',
            'birthday' => 'Birthday',
            'telephone' => 'Telephone',
            'site' => 'Site',
            'role' => 'Role',
            'company' => 'Company',
            'about' => 'About',
            'photo_link' => 'Photo Link',
            'city' => 'City',
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
