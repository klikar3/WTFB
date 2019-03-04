<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "anrede".
 *
 * @property string $anrId
 * @property string $inhalt
 */
class Anrede extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anrede';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inhalt'], 'required'],
            [['inhalt'], 'string', 'max' => 45],
            [['inhalt'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'anrId' => Yii::t('app', 'Anr ID'),
            'inhalt' => Yii::t('app', 'Inhalt'),
        ];
    }
}
