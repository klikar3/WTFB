<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "disziplinen".
 *
 * @property int $DispId a
 * @property string $DispName
 * @property int $sort
 * @property string $DispKurz
 *
 * @property Grade[] $grades
 * @property Mitgliederdisziplinen[] $mitgliederdisziplinens
 * @property Schulen[] $schulens
 */
class Disziplinen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'disziplinen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DispName', 'sort', 'DispKurz'], 'required'],
            [['sort'], 'integer'],
            [['DispName'], 'string', 'max' => 30],
            [['DispKurz'], 'string', 'max' => 5],
            [['DispName'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'DispId' => Yii::t('app', 'Disp ID'),
            'DispName' => Yii::t('app', 'Disp Name'),
            'sort' => Yii::t('app', 'Sort'),
            'DispKurz' => Yii::t('app', 'Disp Kurz'),
        ];
    }

    /**
     * Gets query for [[Grades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrades()
    {
        return $this->hasMany(Grade::className(), ['DispName' => 'DispName']);
    }

    /**
     * Gets query for [[Mitgliederdisziplinens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMitgliederdisziplinens()
    {
        return $this->hasMany(Mitgliederdisziplinen::className(), ['DisziplinId' => 'DispId']);
    }

    /**
     * Gets query for [[Schulens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchulens()
    {
        return $this->hasMany(Schulen::className(), ['Disziplin' => 'DispId']);
    }
}
