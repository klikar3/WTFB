<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Anrede;

/**
 * AnredeSearch represents the model behind the search form about `frontend\models\Anrede`.
 */
class AnredeSearch extends Anrede
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anrId'], 'integer'],
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
        $query = Anrede::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'anrId' => $this->anrId,
        ]);

        $query->andFilterWhere(['like', 'inhalt', $this->inhalt]);

        return $dataProvider;
    }
}
