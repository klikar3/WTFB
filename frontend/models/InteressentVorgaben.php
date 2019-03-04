<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "interessent_vorgaben".
 *
 * @property string $id
 * @property string $code
 * @property string $wert
 * @property string $sort
 */
class InteressentVorgaben extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'interessent_vorgaben';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'wert', 'sort'], 'required'],
            [['sort'], 'integer'],
            [['code', 'wert'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'wert' => Yii::t('app', 'Wert'),
            'sort' => Yii::t('app', 'Sort'),
        ];
    }
}
