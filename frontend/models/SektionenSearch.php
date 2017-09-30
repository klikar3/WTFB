<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Sektionen;

/**
 * SektionenSearch represents the model behind the search form of `app\models\Sektionen`.
 */
class SektionenSearch extends Sektionen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sekt_id'], 'integer'],
            [['kurz', 'name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Sektionen::find();

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
            'sekt_id' => $this->sekt_id,
        ]);

        $query->andFilterWhere(['like', 'kurz', $this->kurz])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
