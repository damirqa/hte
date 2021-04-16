<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string $annotation
 * @property string $description
 * @property string|null $date
 * @property float|null $price
 * @property int|null $customer_id
 * @property int|null $performer_id
 * @property string|null $task_status
 * @property int|null $on_time
 * @property string|null $planned_execution_time
 * @property string|null $actual_execution_time
 * @property int|null $urgently
 *
 * @property Profile $customer
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'type', 'annotation', 'description'], 'required'],
            [['description'], 'string'],
            [['date', 'planned_execution_time', 'actual_execution_time'], 'safe'],
            [['price'], 'number'],
            [['customer_id', 'performer_id', 'offer_id'], 'integer'],
            [['title', 'type', 'annotation', 'task_status', 'urgently', 'on_time'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'type' => 'Тип работ',
            'annotation' => 'Аннотация',
            'description' => 'Описание',
            'date' => 'Дата создания',
            'price' => 'Цена',
            'customer_id' => 'ИД заказчика',
            'performer_id' => 'ИД исполнителя',
            'offer_id' => 'ИД предложения',
            'task_status' => 'Статус задачи',
            'on_time' => 'Исполнитель обязан выполнить задачу вовремя или допускаются задержки?',
            'planned_execution_time' => 'Дата завершения',
            'actual_execution_time' => 'Фактическое Время Выполнения',
            'urgently' => 'Срочно',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Profile::className(), ['id' => 'customer_id']);
    }
}
