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
            [['MitgliederId', 'SchulId', 'Von', 'Bis'], 'required'],
            [['MitgliederId', 'SchulId', 'VertragId'], 'integer'],
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
            'VertragId' => Yii::t('app', 'Vertrag ID'),
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
