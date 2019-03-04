<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Mitgliederdisziplinen;

/**
 * MitgliederdisziplinenSearch represents the model behind the search form about `frontend\models\Mitgliederdisziplinen`.
 */
class MitgliederdisziplinenSearch extends Mitgliederdisziplinen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maId', 'MitgliedId', 'DisziplinId'], 'integer'],
            [['Von', 'Bis'], 'safe'],
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
        $query = Mitgliederdisziplinen::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'maId' => $this->maId,
            'MitgliedId' => $this->MitgliedId,
            'DisziplinId' => $this->DisziplinId,
            'Von' => $this->Von,
            'Bis' => $this->Bis,
        ]);

        return $dataProvider;
    }
}
