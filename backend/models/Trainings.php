<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "trainings".
 *
 * @property int $id
 * @property int $schulId
 * @property string $description
 *
 * @property Anwesenheitsliste[] $anwesenheitslistes
 */
class Trainings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trainings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['schulId', 'description'], 'required'],
            [['schulId'], 'integer'],
            [['description'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'schulId' => Yii::t('app', 'Schul ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * Gets query for [[Anwesenheitslistes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnwesenheitslistes()
    {
        return $this->hasMany(Anwesenheitsliste::className(), ['training' => 'id']);
    }
}
