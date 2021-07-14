<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "solution".
 *
 * @property int $id
 * @property int $id_project
 * @property string|null $date_create
 * @property string|null $date_change
 * @property string|null $status
 * @property string|null $comment
 * @property string $files_link
 * @property Project $project
 */
class Solution extends \yii\db\ActiveRecord
{
    public $files;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'solution';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_project'], 'required'],
            [['id_project'], 'integer'],
            [['date_create', 'date_change'], 'safe'],
            [['comment', 'files_link'], 'string'],
            [['status'], 'string', 'max' => 255],
            [['id_project'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['id_project' => 'id']],
            [['imageFiles'], 'file', 'extensions' => 'png, jpg, rar, zip', 'maxFiles' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ИД',
            'id_project' => 'ИД Проекта',
            'date_create' => 'Дата создания',
            'date_change' => 'Дата редактирования',
            'status' => 'Статус',
            'files_link' => 'Ссылки на файлы',
            'comment' => 'Коммент',
        ];
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'id_project']);
    }
}
