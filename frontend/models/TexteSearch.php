<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Texte;

/**
 * TexteSearch represents the model behind the search form about `frontend\models\Texte`.
 */
class TexteSearch extends Texte
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'SchulId', 'quer', 'randLinks'], 'integer'],
            [['code', 'fuer', 'txt', 'betreff'], 'safe'],
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
        $query = Texte::find();

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
            'SchulId' => $this->SchulId,
            'quer' => $this->quer,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'fuer', $this->fuer])
            ->andFilterWhere(['like', 'txt', $this->txt])
            ->andFilterWhere(['like', 'betreff', $this->betreff]);

        return $dataProvider;
    }
}
