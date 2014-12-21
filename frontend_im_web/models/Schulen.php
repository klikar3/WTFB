<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "schulen".
 *
 * @property string $SchulId
 * @property string $Schulname
 * @property integer $sort
 * @property string $Disziplin
 *
 * @property Mitgliederschulen[] $mitgliederschulens
 * @property Schulleiterschulen[] $schulleiterschulens
 */
class Schulen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schulen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Schulname', 'sort', 'Disziplin'], 'required'],
            [['sort'], 'integer'],
            [['Schulname'], 'string', 'max' => 50],
            [['Disziplin'], 'string', 'max' => 30],
            [['Schulname', 'Disziplin'], 'unique', 'targetAttribute' => ['Schulname', 'Disziplin'], 'message' => 'The combination of Schulname and Disziplin has already been taken.'],
            [['Schulname', 'Disziplin'], 'unique', 'targetAttribute' => ['Schulname', 'Disziplin'], 'message' => 'The combination of Schulname and Disziplin has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SchulId' => Yii::t('app', 'Schul ID'),
            'Schulname' => Yii::t('app', 'Schulname'),
            'sort' => Yii::t('app', 'Sort'),
            'Disziplin' => Yii::t('app', 'Disziplin'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitgliederschulens()
    {
        return $this->hasMany(Mitgliederschulen::className(), ['SchulId' => 'SchulId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchulleiterschulens()
    {
        return $this->hasMany(Schulleiterschulen::className(), ['SchulId' => 'SchulId']);
    }
}
