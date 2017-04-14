<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Sifu;

/**
 * SifuSearch represents the model behind the search form about `frontend\models\Sifu`.
 */
class SifuSearch extends Sifu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sId', 'mitglidId'], 'integer'],
            [['SifuName'], 'safe'],
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
        $query = Sifu::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'sId' => $this->sId,
            'mitglidId' => $this->mitglidId,
        ]);

        $query->andFilterWhere(['like', 'SifuName', $this->SifuName]);

        return $dataProvider;
    }
}
