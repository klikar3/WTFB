<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mitgliederschulen".
 *
 * @property string $msID
 * @property integer $MitgliederId
 * @property string $SchulId
 * @property string $Von
 * @property string $Bis
 * @property string $VertragId
 *
 * @property Schulen $schul
 * @property Mitglieder $mitglieder
 * @property Vertrag $vertrag
 */
class Mitgliederschulen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mitgliederschulen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MitgliederId', 'SchulId', 'Von'], 'required'],
            [['MitgliederId', 'SchulId', 'VertragId', 'VDauerMonate'], 'integer'],
            [['Von', 'Bis'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'msID' => Yii::t('app', 'a'),
            'MitgliederId' => Yii::t('app', 'Mitglieder ID'),
            'SchulId' => Yii::t('app', 'Schul ID'),
            'Von' => Yii::t('app', 'Von'),
            'Bis' => Yii::t('app', 'Bis'),
            'VertragId' => Yii::t('app', 'Vertrag'),
						'KuendigungAm' => Yii::t('app', 'Kündigung'),
						'VDauerMonate' => Yii::t('app', 'V.Dauer'),
						'MonatsBeitrag' => Yii::t('app', 'M-Beitrag'),
						'ZahlungsArt' => Yii::t('app', 'Zahlg.Art'), 
						'ZahlungsWeise' => Yii::t('app', 'Zahlungsw.'),
						'BeitragAussetzenVon' => Yii::t('app', 'Beitrag auss. Von'), 
						'BeitragAussetzenBis' => Yii::t('app', 'Beitrag auss. Bis'), 
						'BeitragAussetzenGrund' => Yii::t('app', 'Beitrag auss. Grund'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchul()
    {
        return $this->hasOne(Schulen::className(), ['SchulId' => 'SchulId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitglieder()
    {
        return $this->hasOne(Mitglieder::className(), ['MitgliederId' => 'MitgliederId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVertrag()
    {
        return $this->hasOne(Vertrag::className(), ['VertragId' => 'VertragId']);
    }
}
