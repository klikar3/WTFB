<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "schulleiterschulen".
 *
 * @property string $ssId
 * @property integer $LeiterId
 * @property string $SchulId
 * @property string $DispId
 *
 * @property Disziplinen $disp
 * @property Schulleiter $leiter
 * @property Schulen $schul
 */
class Schulleiterschulen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schulleiterschulen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LeiterId', 'SchulId', 'DispId'], 'required'],
            [['LeiterId', 'SchulId', 'DispId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ssId' => Yii::t('app', 'Ss ID'),
            'LeiterId' => Yii::t('app', 'Leiter ID'),
            'SchulId' => Yii::t('app', 'Schul ID'),
            'DispId' => Yii::t('app', 'Disp ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisp()
    {
        return $this->hasOne(Disziplinen::className(), ['DispId' => 'DispId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeiter()
    {
        return $this->hasOne(Schulleiter::className(), ['LeiterId' => 'LeiterId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchul()
    {
        return $this->hasOne(Schulen::className(), ['SchulId' => 'SchulId']);
    }
}
