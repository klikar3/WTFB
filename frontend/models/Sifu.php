<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sifu".
 *
 * @property string $sId
 * @property string $SifuName
 * @property string $mitglidId
 */
class Sifu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sifu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SifuName', 'mitglidId'], 'required'],
            [['mitglidId'], 'integer'],
            [['SifuName'], 'string', 'max' => 45],
            [['SifuName'], 'unique'],
            [['mitglidId'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sId' => Yii::t('app', 'S ID'),
            'SifuName' => Yii::t('app', 'Sifu Name'),
            'mitglidId' => Yii::t('app', 'Mitglid ID'),
        ];
    }
}
