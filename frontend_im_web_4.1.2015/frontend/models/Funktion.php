<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "funktion".
 *
 * @property string $funkId
 * @property string $inhalt
 */
class Funktion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'funktion';
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
            'funkId' => Yii::t('app', 'Funk ID'),
            'inhalt' => Yii::t('app', 'Inhalt'),
        ];
    }
}
