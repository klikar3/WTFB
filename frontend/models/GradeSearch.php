<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Grade;

/**
 * GradeSearch represents the model behind the search form about `frontend\models\Grade`.
 */
class GradeSearch extends Grade
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gradId', 'sort'], 'integer'],
            [['GradName', 'DispName', 'gKurz'], 'safe'],
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
//        $query = Mitgliederschulen::find()->with('schul')->with('schul.disziplinen')->innerJoinWith('mgl', true)->innerJoinWith('mitglieder', true)
//                  ->select('*, mitgliederliste.Name,mitgliederliste.Vertrag, mitgliederliste.Grad, mitglieder.letzteDvd, mitglieder.DVDgesendetAm,mitglieder.Woher');
        $query = Grade::find()->with('disziplin')->select(['*', 'concat(gKurz," ",disziplin.DispKurz) as gkdks']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'gradId' => $this->gradId,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'GradName', $this->GradName])
            ->andFilterWhere(['like', 'DispName', $this->DispName])
            ->andFilterWhere(['like', 'gKurz', $this->gKurz]);

        return $dataProvider;
    }
}
