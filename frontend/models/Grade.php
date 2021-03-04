<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "grade".
 *
 * @property string $gradId
 * @property string $GradName
 * @property string $DispName
 * @property string $sort
 * @property string $gKurz
 * @property string $textcode
 * @property string $print
*
 * @property Disziplinen $dispName
 * @property Mitgliedergrade[] $mitgliedergrades
 */
class Grade extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GradName', 'DispName', 'gKurz', 'textcode','print'], 'required'],
            [['sort'], 'integer'],
            [['Gebuehr'],'number'],
            [['GradName', 'DispName'], 'string', 'max' => 30],
            [['textcode','print'], 'string', 'max' => 50],
            [['gKurz'], 'string', 'max' => 10],
            [['GradName', 'DispName'], 'unique', 'targetAttribute' => ['GradName', 'DispName'], 'message' => 'The combination of Grad Name and Disp Name has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gradId' => Yii::t('app', 'Grad ID'),
            'GradName' => Yii::t('app', 'Grad Name'),
            'DispName' => Yii::t('app', 'Disp Name'),
            'sort' => Yii::t('app', 'Sort'),
            'gKurz' => Yii::t('app', 'G Kurz'),
            'Gebuehr' => Yii::t('app', 'Gebühr'),
            'textcode' => Yii::t('app', 'TextCode'),
            'print' => Yii::t('app', 'Print'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
/*    public function getDispName()
    {
        return $this->hasOne(Disziplinen::className(), ['DispName' => 'DispName']);
    }
*/
    public function getDisziplin()
    {
        return $this->hasOne(Disziplinen::className(), ['DispName' => 'DispName']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitgliedergrades()
    {
        return $this->hasMany(Mitgliedergrade::className(), ['GradId' => 'gradId']);
    }

    public function getGkdk()
    {
        return $this->gKurz." ".$this->disziplin->DispKurz;
    }

}
