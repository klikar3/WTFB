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
		public $Name;
    public $groesserVon;
    public $kleinerBis;

    public function rules()
    {
        return [
            [['msID', 'MitgliederId', 'VertragId'], 'integer'],
            [['VDatum', 'Von', 'Bis', 'SchulId', 'KuendigungAm','MonatsBeitrag', 'ZahlungsArt', 'Zahlungsweise', 'NameLink','Vertrag', 'Grad', 'mitgliederschulen.SchulId', 'Name', 'groesserVon'], 'safe'],
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
        $query = Mitgliederschulen::find()->innerJoinWith('mgl', true)
                  ->select('*, mitgliederliste.Name,mitgliederliste.Vertrag, mitgliederliste.Grad');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort([
		    		'defaultOrder' => ['Bis'=>SORT_DESC],
		        'attributes' => [
		            'Von',
		            'Bis',
		            'mitgliederschulen.SchulId',
                'VDatum',
                'Vertrag',
                'Grad',
		            'KuendigungAm','MonatsBeitrag', 'ZahlungsArt', 'Zahlungsweise',
                'Name',		            
                'NameLink' => [
		                'asc' => ['mitgliederliste.Name' => SORT_ASC],
		                'desc' => ['mitgliederliste.Name' => SORT_DESC],
		                'label' => 'Name',
		                'default' => SORT_ASC,
		            ],  
		        ]
		    ]);

        $this->load($params);
/*        if (!$this->validate()) {
            return $dataProvider;
        }
*/
        $query->andFilterWhere([
            'msID' => $this->msID,
            'MitgliederId' => $this->MitgliederId,
//            'mitgliederschulen.SchulId' => $this->SchulId,
            'VDatum' => $this->VDatum,
            'Von' => $this->Von,
            'Bis' => $this->Bis,
            'VertragId' => $this->VertragId,
            'MonatsBeitrag' => $this->MonatsBeitrag, 
            'ZahlungsArt' => $this->ZahlungsArt, 
            'Zahlungsweise' => $this->Zahlungsweise,
            'Grad' => $this->Grad,
            'Name' => $this->Name,
        ]);
        if (!empty($this->groesserVon)) {
            $query->andWhere(['<', 'Von', $this->groesserVon]);
            $query->andWhere(['OR', ['>', 'Bis', $this->groesserVon],
                                    ['is','Bis', new \yii\db\Expression('null')]]);
        }
    		if (!empty($this->Name)) $query->andWhere('mitgliederliste.Name LIKE "%' . $this->Name . '%" '  );
    		if (!empty($this->Grad)) $query->andWhere('mitgliederliste.Grad LIKE "%' . $this->Grad . '%" '  );
        if (!empty($this->SchulId)) {
    		    $query->andWhere('mitgliederschulen.SchulId IN (' . $this->SchulId . ') '  );
        }
//        $query->andFilterCompare('von', $this->Von,'='  );

/*        foreach (Mitgliederschulen::getSearchColumns() as $columnname){
            $operator = $this->getOperator($this->$columnname);
            $operand = str_replace($operator,'',$this->$columnname);
            $query->andFilterWhere([$operator, $columnname, $operand]);
        }
*/        
        return $dataProvider;
    }


    private function getOperator($qryString){
        switch ($qryString){
            case strpos($qryString,'>=') === 0:
                $operator = '>='; 
            break;
            case strpos($qryString,'>') === 0:
                $operator = '>';
                break;
            case strpos($qryString,'<=') === 0:
                $operator = '<=';
                break;
            case strpos($qryString,'<') === 0:
                $operator = '<';
                break;
            case strpos($qryString,'|') === 0:
                $operator = 'or';
                break;
            default:
                $operator =  'like';
                break;
        }
        return $operator;
    }
}
