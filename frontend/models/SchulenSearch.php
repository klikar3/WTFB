<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Schulen;

/**
 * SchulenSearch represents the model behind the search form about `frontend\models\Schulen`.
 */
class SchulenSearch extends Schulen
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           [['SchulId', 'sort', 'Disziplin', 'swmInteressentenListe', 'swmInteressentenForm', 'swmMitgliederListe', 'swmMitgliederForm'], 'integer'],
           [['Schulname'], 'safe'],
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
        $query = Schulen::find()->with('disziplinen');

       // add conditions that should always apply here 
		 
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // grid filtering conditions 
         $query->andFilterWhere([
             'SchulId' => $this->SchulId,
             'sort' => $this->sort,
             'Disziplin' => $this->Disziplin, 
             'swmInteressentenListe' => $this->swmInteressentenListe, 
             'swmInteressentenForm' => $this->swmInteressentenForm, 
             'swmMitgliederListe' => $this->swmMitgliederListe, 
             'swmMitgliederForm' => $this->swmMitgliederForm, 
         ]);     

        $query->andFilterWhere(['like', 'Schulname', $this->Schulname]);
//            ->andFilterWhere(['like', 'Disziplin', $this->Disziplin]);

        return $dataProvider;
    }
}
