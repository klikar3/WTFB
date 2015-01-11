<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mitgliedergrade".
 *
 * @property string $mgID
 * @property integer $MitgliedId
 * @property string $GradId
 * @property string $Datum
 * @property string $PrueferId
 *
 * @property Pruefer $pruefer
 * @property Mitglieder $mitglied
 * @property Grade $grad
 */
class Mitgliedergrade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mitgliedergrade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MitgliedId', 'GradId', 'Datum', 'PrueferId'], 'required'],
            [['MitgliedId', 'GradId', 'PrueferId'], 'integer'],
            [['Datum'], 'safe'],
            [['MitgliedId', 'GradId'], 'unique', 'targetAttribute' => ['MitgliedId', 'GradId'], 'message' => 'The combination of Mitglied ID and Grad ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mgID' => Yii::t('app', 'a'),
            'MitgliedId' => Yii::t('app', 'Mitglied ID'),
            'GradId' => Yii::t('app', 'Grad ID'),
            'Datum' => Yii::t('app', 'Datum'),
            'PrueferId' => Yii::t('app', 'Pruefer ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPruefer()
    {
        return $this->hasOne(Pruefer::className(), ['prueferId' => 'PrueferId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitglied()
    {
        return $this->hasOne(Mitglieder::className(), ['MitgliederId' => 'MitgliedId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrad()
    {
        return $this->hasOne(Grade::className(), ['gradId' => 'GradId']);
    }
    
    public function getDisziplinen()
    {
        return $this->hasone(Disziplinen::className(), ['DispName' => 'DispName'])
            ->viaTable('grade', ['gradId' => 'GradId']);
    }
    
}
