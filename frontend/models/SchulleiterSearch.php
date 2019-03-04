<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Schulleiter;

/**
 * SchulleiterSearch represents the model behind the search form about `frontend\models\Schulleiter`.
 */
class SchulleiterSearch extends Schulleiter
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LeiterId'], 'integer'],
            [['LeiterName'], 'safe'],
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
        $query = Schulleiter::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'LeiterId' => $this->LeiterId,
        ]);

        $query->andFilterWhere(['like', 'LeiterName', $this->LeiterName]);

        return $dataProvider;
    }
}
