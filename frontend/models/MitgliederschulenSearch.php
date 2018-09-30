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
		public $NameLink;

    public function rules()
    {
        return [
            [['msID', 'MitgliederId', 'SchulId', 'VertragId'], 'integer'],
            [['VDatum', 'Von', 'Bis', 'KuendigungAm','MonatsBeitrag', 'ZahlungsArt', 'Zahlungsweise', 'NameLink'], 'safe'],
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
        $query = Mitgliederschulen::find()->innerJoinWith('mitglieder', true);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
		    		'defaultOrder' => ['Bis'=>SORT_DESC],
		        'attributes' => [
		            'Von',
		            'Bis',
		            'SchulId',
                'VDatum',
		            'KuendigungAm','MonatsBeitrag', 'ZahlungsArt', 'Zahlungsweise',		            
                'NameLink' => [
		                'asc' => ['mitglieder.Name' => SORT_ASC],
		                'desc' => ['mitglieder.Name' => SORT_DESC],
		                'label' => 'Name',
		                'default' => SORT_ASC,
		            ],  
		        ]
		    ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'msID' => $this->msID,
            'MitgliederId' => $this->MitgliederId,
            'SchulId' => $this->SchulId,
            'VDatum' => $this->VDatum,
            'Von' => $this->Von,
            'Bis' => $this->Bis,
            'VertragId' => $this->VertragId,
            'MonatsBeitrag' => $this->MonatsBeitrag, 
            'ZahlungsArt' => $this->ZahlungsArt, 
            'Zahlungsweise' => $this->Zahlungsweise,
//            'NameLink' => $this->NameLink,
        ]);
    		$query->andWhere('mitglieder.Name LIKE "%' . $this->NameLink . '%" '  );

        return $dataProvider;
    }
}
