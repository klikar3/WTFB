<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Anwesenheit;

/**
 * AnwesenheitSearch represents the model behind the search form of `frontend\models\Anwesenheit`.
 */
class AnwesenheitSearch extends Anwesenheit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'trainingsId', 'anzahl'], 'integer'],
            [['datum'], 'safe'],
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
        $query = Anwesenheit::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'trainingsId' => $this->trainingsId,
            'datum' => $this->datum,
            'anzahl' => $this->anzahl,
        ]);

        return $dataProvider;
    }
}
