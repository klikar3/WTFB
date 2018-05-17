<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Mitgliederschulen;

/**
 * MitgliederschulenSearch represents the model behind the search form about `frontend\models\Mitgliederschulen`.
 */
class MitgliederschulenSearch extends Mitgliederschulen
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['msID', 'MitgliederId', 'SchulId', 'VertragId'], 'integer'],
            [['Von', 'Bis', 'KuendigungAm'], 'safe'],
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
        $query = Mitgliederschulen::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
		    		'defaultOrder' => ['Bis'=>SORT_DESC],
		        'attributes' => [
		            'Von',
		            'Bis',
		            'KuendigungAm',
		        ]
		    ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'msID' => $this->msID,
            'MitgliederId' => $this->MitgliederId,
            'SchulId' => $this->SchulId,
            'Von' => $this->Von,
            'Bis' => $this->Bis,
            'VertragId' => $this->VertragId,
        ]);

        return $dataProvider;
    }
}
