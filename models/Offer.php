<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "offer".
 *
 * @property int $id
 * @property int|null $id_project
 * @property int|null $performer_id
 * @property float|null $bid
 * @property string|null $date
 * @property string|null $scheduled_time_performer
 * @property string|null $text
 *
 * @property Profile $performer
 * @property Project $project
 */
class Offer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_project', 'performer_id'], 'integer'],
            [['bid'], 'number'],
            [['date', 'scheduled_time_performer'], 'safe'],
            [['text'], 'string', 'max' => 255],
            [['performer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['performer_id' => 'id']],
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
            'performer_id' => 'Performer ID',
            'bid' => 'Bid',
            'date' => 'Date',
            'scheduled_time_performer' => 'Scheduled Time Performer',
            'text' => 'Text',
        ];
    }

    /**
     * Gets query for [[Performer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerformer()
    {
        return $this->hasOne(Profile::className(), ['id' => 'performer_id']);
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
