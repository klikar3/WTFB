<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "vertrag".
 *
 * @property string $VertragId
 * @property resource $pdf
 *
 * @property Mitgliederschulen[] $mitgliederschulens
 */
class Vertrag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vertrag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pdf'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'VertragId' => Yii::t('app', 'Vertrag ID'),
            'pdf' => Yii::t('app', 'Pdf'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitgliederschulens()
    {
        return $this->hasMany(Mitgliederschulen::className(), ['VertragId' => 'VertragId']);
    }
}
