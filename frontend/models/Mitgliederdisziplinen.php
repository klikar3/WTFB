<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mitgliederdisziplinen".
 *
 * @property string $maId
 * @property integer $MitgliedId
 * @property string $DisziplinId
 * @property string $Von
 * @property string $Bis
 *
 * @property Disziplinen $disziplin
 * @property Mitglieder $mitglied
 */
class Mitgliederdisziplinen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mitgliederdisziplinen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MitgliedId', 'DisziplinId', 'Von', 'Bis'], 'required'],
            [['MitgliedId', 'DisziplinId'], 'integer'],
            [['Von', 'Bis'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'maId' => Yii::t('app', 'a'),
            'MitgliedId' => Yii::t('app', 'Mitglied ID'),
            'DisziplinId' => Yii::t('app', 'Disziplin ID'),
            'Von' => Yii::t('app', 'Von'),
            'Bis' => Yii::t('app', 'Bis'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisziplin()
    {
        return $this->hasOne(Disziplinen::className(), ['DispId' => 'DisziplinId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitglied()
    {
        return $this->hasOne(Mitglieder::className(), ['MitgliederId' => 'MitgliedId']);
    }
}
