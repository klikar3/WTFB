<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Intensiv;

/**
 * IntensivSearch represents the model behind the search form of `frontend\models\Intensiv`.
 */
class IntensivSearch extends Intensiv
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'mitgliederId', 'alter'], 'integer'],
            [['kontaktNachricht', 'graduierung', 'wieLangeWt', 'ausbQuali', 'unterrichtet', 'eigeneSchule', 'eigeneLehrer', 'organisation', 'erfAndereStile', 'ziel', 'wievielZeit', 'trainingsPartner', 'erstTermin', 'einstufung', 'bemerkung'], 'safe'],
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
        $query = Intensiv::find();

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
            'mitgliederId' => $this->mitgliederId,
            'alter' => $this->alter,
            'erstTermin' => $this->erstTermin,
        ]);

        $query->andFilterWhere(['like', 'kontaktNachricht', $this->kontaktNachricht])
            ->andFilterWhere(['like', 'graduierung', $this->graduierung])
            ->andFilterWhere(['like', 'wieLangeWt', $this->wieLangeWt])
            ->andFilterWhere(['like', 'ausbQuali', $this->ausbQuali])
            ->andFilterWhere(['like', 'unterrichtet', $this->unterrichtet])
            ->andFilterWhere(['like', 'eigeneSchule', $this->eigeneSchule])
            ->andFilterWhere(['like', 'eigeneLehrer', $this->eigeneLehrer])
            ->andFilterWhere(['like', 'organisation', $this->organisation])
            ->andFilterWhere(['like', 'erfAndereStile', $this->erfAndereStile])
            ->andFilterWhere(['like', 'ziel', $this->ziel])
            ->andFilterWhere(['like', 'wievielZeit', $this->wievielZeit])
            ->andFilterWhere(['like', 'trainingsPartner', $this->trainingsPartner])
            ->andFilterWhere(['like', 'bemerkung', $this->bemerkung])
            ->andFilterWhere(['like', 'einstufung', $this->einstufung]);

        return $dataProvider;
    }
}
