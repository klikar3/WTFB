<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pruefer".
 *
 * @property string $prueferId
 * @property string $pName
 * @property string $sort
 *
 * @property Mitgliedergrade[] $mitgliedergrades
 */
class Pruefer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pruefer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prueferId', 'pName', 'sort'], 'required'],
            [['prueferId', 'sort'], 'integer'],
            [['pName'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prueferId' => Yii::t('app', 'Pruefer ID'),
            'pName' => Yii::t('app', 'P Name'),
            'sort' => Yii::t('app', 'Sort'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitgliedergrades()
    {
        return $this->hasMany(Mitgliedergrade::className(), ['PrueferId' => 'prueferId']);
    }
}
