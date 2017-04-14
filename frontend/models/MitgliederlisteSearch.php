<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Mitgliederliste;

/**
 * MitgliederSearch represents the model behind the search form about `app\models\Mitglieder`.
 */
class MitgliederlisteSearch extends Mitgliederliste
{
		/* your calculated attribute */
		public $NameLink;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MitgliederId', 'MitgliedsNr'], 'integer'],
            [['LetzteAenderung'],'date', 'format' => 'd.m.Y'],
            [['MitgliedsNr', 'Vorname', 'Nachname', 'Name', 'NameLink', 'Schulname', 'LeiterName', 'DispName', 'Vertrag', 'PruefungZum', 'Grad', 'Funktion','LetzteAenderung'], 'safe'],
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
        $query = Mitgliederliste::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
				
		    $dataProvider->setSort([
		    		'defaultOrder' => ['NameLink'=>SORT_ASC],
		        'attributes' => [
		            'MitgliederId',
		            'NameLink' => [
		                'asc' => ['Name' => SORT_ASC],
		                'desc' => ['Name' => SORT_DESC],
		                'label' => 'Name',
		                'default' => SORT_ASC,
		            ],  
		            'Schulname',
		            'LeiterName',
		            'DispName',
		            'Vertrag',
		            'Funktion',
		            'Vertreg',
		            'Grad',
		            'LetzteAenderung'
		        ]
		    ]); 

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

				 // The following condition is important and must be changed. The $_GET validation
				// is important (or you can use $_POST if you have configured post method).
				// Without this validation saved filters cannot be applied.
				if (isset($_GET['MitgliederlisteSearch']) && !($this->load($params) && $this->validate())) {
						return $dataProvider;
				}
		    
		    $query->andFilterWhere([
            'MitgliederId' => $this->MitgliederId,
        ]);

        $query->andFilterWhere(['like', 'MitgliedsNr', $this->MitgliedsNr])
            ->andFilterWhere(['like', 'Vorname', $this->Vorname])
            ->andFilterWhere(['like', 'Nachname', $this->Nachname])
//            ->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'Schulname', $this->Schulname])
            ->andFilterWhere(['like', 'LeiterName', $this->LeiterName])
            ->andFilterWhere(['like', 'DispName', $this->DispName])
            ->andFilterWhere(['like', 'Vertrag', $this->Vertrag])
//            ->andFilterWhere(['like', 'PruefungZum', $this->PruefungZum])
            ->andFilterWhere(['like', 'Grad', $this->Grad])
            ->andFilterWhere(['like', 'Funktion', $this->Funktion])
;
				if ($this->PruefungZum) {
						$query->andFilterWhere(['>', 'PruefungZum', 0 /*$this->PruefungZum*/]);
				};
    		$query->andWhere('Name LIKE "%' . $this->NameLink . '%" '  );
        $query->andWhere('LetzteAenderung >= STR_TO_DATE("' . $this->LetzteAenderung . '" , "%e.%c.%Y %H:%i:%s")' );
//				if ($this->LetzteAenderung) {
//						$query->andFilterWhere(['>=', 'LetzteAenderung', $this->LetzteAenderung]);
//				};
		    
        return $dataProvider;
    }
}
