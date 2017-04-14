<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Schulleiterschulen;

/**
 * SchulleiterschulenSearch represents the model behind the search form about `frontend\models\Schulleiterschulen`.
 */
class SchulleiterschulenSearch extends Schulleiterschulen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ssId', 'LeiterId', 'SchulId'], 'integer'],
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
        $query = Schulleiterschulen::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ssId' => $this->ssId,
            'LeiterId' => $this->LeiterId,
            'SchulId' => $this->SchulId,
        ]);

        return $dataProvider;
    }
}
