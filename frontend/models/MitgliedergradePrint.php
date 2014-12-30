<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Mitgliedergrade;

/**
 * MitgliedergradeSearch represents the model behind the search form about `frontend\models\Mitgliedergrade`.
 */
class MitgliedergradePrint extends Mitgliedergrade
{
    public $print;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mgID', 'MitgliedId', 'GradId', 'PrueferId'], 'integer'],
            [['print'],'boolean'],
            [['Datum', 'print'], 'safe'],
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mgID' => Yii::t('app', 'mgID'),
            'MitgliedId' => Yii::t('app', 'MitgliedId'),
            'GradId' => Yii::t('app', 'GradId'),
            'PrueferId' => Yii::t('app', 'PrueferId'),
            'print' => Yii::t('app', 'Urkunde sofort drucken'),
            'Datum' => Yii::t('app', 'Datum')
            
        ];
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
        $query = Mitgliedergrade::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'mgID' => $this->mgID,
            'MitgliedId' => $this->MitgliedId,
            'GradId' => $this->GradId,
            'Datum' => $this->Datum,
            'PrueferId' => $this->PrueferId,
        ]);

        return $dataProvider;
    }
}
