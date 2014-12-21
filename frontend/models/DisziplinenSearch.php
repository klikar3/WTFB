<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Disziplinen;

/**
 * DisziplinenSearch represents the model behind the search form about `frontend\models\Disziplinen`.
 */
class DisziplinenSearch extends Disziplinen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DispId', 'sort'], 'integer'],
            [['DispName', 'DispKurz'], 'safe'],
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
        $query = Disziplinen::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'DispId' => $this->DispId,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'DispName', $this->DispName])
            ->andFilterWhere(['like', 'DispKurz', $this->DispKurz]);

        return $dataProvider;
    }
}
