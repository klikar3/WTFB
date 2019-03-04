<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pruefungen".
 *
 * @property int $id
 * @property string $dispId
 * @property string $datum
 * @property string $prueferId
 * @property int $erledigt
 *
 * @property Disziplinen $disp
 * @property Pruefer $pruefer
 */
class Pruefungen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pruefungen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dispId', 'prueferId', 'erledigt'], 'integer'],
            [['datum'], 'safe'],
            [['dispId'], 'exist', 'skipOnError' => true, 'targetClass' => Disziplinen::className(), 'targetAttribute' => ['dispId' => 'DispId']],
            [['prueferId'], 'exist', 'skipOnError' => true, 'targetClass' => Pruefer::className(), 'targetAttribute' => ['prueferId' => 'prueferId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dispId' => Yii::t('app', 'Disp ID'),
            'datum' => Yii::t('app', 'Datum'),
            'prueferId' => Yii::t('app', 'Pruefer ID'),
            'erledigt' => Yii::t('app', 'Erledigt'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisp()
    {
        return $this->hasOne(Disziplinen::className(), ['DispId' => 'dispId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPruefer()
    {
        return $this->hasOne(Pruefer::className(), ['prueferId' => 'prueferId']);
    }

    /**
     * {@inheritdoc}
     * @return PruefungenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PruefungenQuery(get_called_class());
    }
}
