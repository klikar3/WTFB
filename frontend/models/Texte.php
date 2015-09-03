<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "texte".
 *
 * @property string $id
 * @property string $code
 * @property string $fuer
 * @property string $txt
 */
class Texte extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'texte';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'fuer', 'txt'], 'required'],
            [['txt'], 'string'],
            [['code'], 'string', 'max' => 50],
            [['fuer'], 'string', 'max' => 99]
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
            'fuer' => Yii::t('app', 'Fuer'),
            'txt' => Yii::t('app', 'Txt'),
        ];
    }
}
