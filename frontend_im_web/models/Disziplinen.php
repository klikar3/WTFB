<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "disziplinen".
 *
 * @property string $DispId
 * @property string $DispName
 * @property integer $sort
 * @property string $DispKurz
 *
 * @property Grade[] $grades
 * @property Mitgliederdisziplinen[] $mitgliederdisziplinens
 * @property Schulleiterschulen[] $schulleiterschulens
 */
class Disziplinen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'disziplinen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DispName', 'sort', 'DispKurz'], 'required'],
            [['sort'], 'integer'],
            [['DispName'], 'string', 'max' => 30],
            [['DispKurz'], 'string', 'max' => 5],
            [['DispName'], 'unique'],
            [['DispName'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DispId' => Yii::t('app', 'a'),
            'DispName' => Yii::t('app', 'Disp Name'),
            'sort' => Yii::t('app', 'Sort'),
            'DispKurz' => Yii::t('app', 'Disp Kurz'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrades()
    {
        return $this->hasMany(Grade::className(), ['DispName' => 'DispName']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitgliederdisziplinens()
    {
        return $this->hasMany(Mitgliederdisziplinen::className(), ['DisziplinId' => 'DispId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchulleiterschulens()
    {
        return $this->hasMany(Schulleiterschulen::className(), ['DispId' => 'DispId']);
    }
}
