<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\project;

/**
 * ProjectSearch represents the model behind the search form of `app\models\project`.
 */
class ProjectSearch extends project
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'performer_id', 'on_time', 'urgently'], 'integer'],
            [['title', 'type', 'annotation', 'description', 'date', 'task_status', 'planned_execution_time', 'actual_execution_time'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = project::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize' => 5 ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'price' => $this->price,
            'customer_id' => $this->customer_id,
            'performer_id' => $this->performer_id,
            'on_time' => $this->on_time,
            'planned_execution_time' => $this->planned_execution_time,
            'actual_execution_time' => $this->actual_execution_time,
            'urgently' => $this->urgently,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'annotation', $this->annotation])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'task_status', $this->task_status]);

        return $dataProvider;
    }
}
