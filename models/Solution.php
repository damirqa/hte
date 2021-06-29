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
 *
 * @property Project $project
 */
class Solution extends \yii\db\ActiveRecord
{
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
            [['comment'], 'string'],
            [['status'], 'string', 'max' => 255],
            [['id_project'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['id_project' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_project' => 'Id Project',
            'date_create' => 'Date Create',
            'date_change' => 'Date Change',
            'status' => 'Status',
            'comment' => 'Comment',
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
