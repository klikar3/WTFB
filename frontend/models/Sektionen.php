<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sektionen".
 *
 * @property int $sekt_id
 * @property string $kurz
 * @property string $name
 *
 * @property Mitgliedersektionen[] $mitgliedersektionens
 */
class Sektionen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sektionen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kurz'], 'required'],
            [['kurz'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 75],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sekt_id' => Yii::t('app', 'Sekt ID'),
            'kurz' => Yii::t('app', 'Kurz'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitgliedersektionens()
    {
        return $this->hasMany(Mitgliedersektionen::className(), ['sektion_id' => 'sekt_id']);
    }
}
