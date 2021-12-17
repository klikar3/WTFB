<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "schulleiter".
 *
 * @property integer $LeiterId
 * @property string $LeiterName
 *
 * @property Schulleiterschulen[] $schulleiterschulens
 */
class Schulleiter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schulleiter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LeiterId', 'LeiterName'], 'required'],
            [['LeiterId'], 'integer'],
            [['LeiterName'], 'string', 'max' => 80],
            [['LeiterName'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LeiterId' => Yii::t('app', 'Leiter ID'),
            'LeiterName' => Yii::t('app', 'Leiter Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchulleiterschulens()
    {
        return $this->hasMany(Schulleiterschulen::className(), ['LeiterId' => 'LeiterId']);
    }
}
