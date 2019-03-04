<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Pruefer;

/**
 * PrueferSearch represents the model behind the search form about `frontend\models\Pruefer`.
 */
class PrueferSearch extends Pruefer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prueferId', 'sort'], 'integer'],
            [['pName'], 'safe'],
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
        $query = Pruefer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'prueferId' => $this->prueferId,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'pName', $this->pName]);

        return $dataProvider;
    }
}
