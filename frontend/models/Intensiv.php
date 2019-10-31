<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "intensiv".
 *
 * @property int $id
 * @property int $mitgliederId
 * @property string $KontaktAm 
 * @property string $KontaktArt 
 * @property string $Woher 
 * @property string $kontaktNachricht
 * @property int $alter
 * @property string $graduierung
 * @property string $wieLangeWt
 * @property string $ausbQuali
 * @property string $unterrichtet
 * @property string $eigeneSchule
 * @property string $eigeneLehrer
 * @property string $organisation
 * @property string $erfAndereStile
 * @property string $ziel
 * @property string $wievielZeit
 * @property string $trainingsPartner
 * @property string $erstTermin
 * @property string $bemerkung
 */
class Intensiv extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'intensiv';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mitgliederId'], 'required'],
            [['mitgliederId', 'alter'], 'integer'],
            [['kontaktNachricht', 'bemerkung'], 'string'],
            [['KontaktAm', 'erstTermin'], 'safe'], 
            [['KontaktArt'], 'string', 'max' => 50],
		        [['Woher'], 'string', 'max' => 27],
		        [['graduierung', 'wieLangeWt', 'ausbQuali', 'unterrichtet', 'eigeneSchule', 'eigeneLehrer', 'organisation', 'ziel', 'wievielZeit', 'trainingsPartner'], 'string', 'max' => 200],
            [['erfAndereStile'], 'string', 'max' => 500],
            [['mitgliederId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mitgliederId' => Yii::t('app', 'Mitglieder ID'),
            'KontaktAm' => Yii::t('app', 'Kontakt Am'), 
		        'KontaktArt' => Yii::t('app', 'Kontakt Art'), 
		        'Woher' => Yii::t('app', 'Woher'), 
		        'kontaktNachricht' => Yii::t('app', 'Kontakt Nachricht'),
            'alter' => Yii::t('app', 'Alter'),
            'graduierung' => Yii::t('app', 'Graduierung'),
            'wieLangeWt' => Yii::t('app', 'Wie Lange Wt'),
            'ausbQuali' => Yii::t('app', 'Ausb Quali'),
            'unterrichtet' => Yii::t('app', 'Unterrichtet'),
            'eigeneSchule' => Yii::t('app', 'Eigene Schule'),
            'eigeneLehrer' => Yii::t('app', 'Eigene Lehrer'),
            'organisation' => Yii::t('app', 'Organisation'),
            'erfAndereStile' => Yii::t('app', 'Erf Andere Stile'),
            'ziel' => Yii::t('app', 'Ziel'),
            'wievielZeit' => Yii::t('app', 'Wieviel Zeit'),
            'trainingsPartner' => Yii::t('app', 'Trainings Partner'),
            'erstTermin' => Yii::t('app', 'Erst Termin'),
            'bemerkung' => Yii::t('app', 'Bemerkung'),
        ];
    }

    public function getMitglied()
    {
        return $this->hasOne(Mitglieder::className(), ['MitgliederId' => 'mitgliederId']);
    }

}
