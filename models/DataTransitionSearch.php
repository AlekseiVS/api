<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DataTransition;

/**
 * DataTransitionSearch represents the model behind the search form of `app\models\DataTransition`.
 */
class DataTransitionSearch extends DataTransition
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'link_id'], 'integer'],
            [['date_transition', 'referer', 'ip_address', 'browser', 'date'], 'safe'],
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
        $query = DataTransition::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => '10'],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
//             $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'link_id' => $this->link_id,
            'date_transition' => $this->date_transition,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'referer', $this->referer])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address])
            ->andFilterWhere(['like', 'browser', $this->browser]);

        return $dataProvider;
    }
}
