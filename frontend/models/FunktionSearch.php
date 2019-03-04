<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Funktion;

/**
 * FunktionSearch represents the model behind the search form about `frontend\models\Funktion`.
 */
class FunktionSearch extends Funktion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['funkId'], 'integer'],
            [['inhalt'], 'safe'],
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
        $query = Funktion::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'funkId' => $this->funkId,
        ]);

        $query->andFilterWhere(['like', 'inhalt', $this->inhalt]);

        return $dataProvider;
    }
}
