<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "anwesenheitsliste".
 *
 * @property int $id
 * @property string $datum
 * @property int $training
 * @property int $schule
 * @property int $mitglied
 *
 * @property Mitglieder $mitglied0
 * @property Schulen $schule0
 * @property Trainings $training0
 */
class Anwesenheitsliste extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anwesenheitsliste';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['datum', 'training', 'schule', 'mitglied'], 'required'],
            [['datum'], 'safe'],
            [['training', 'schule', 'mitglied'], 'integer'],
            [['mitglied'], 'exist', 'skipOnError' => true, 'targetClass' => Mitglieder::className(), 'targetAttribute' => ['mitglied' => 'MitgliederId']],
            [['schule'], 'exist', 'skipOnError' => true, 'targetClass' => Schulen::className(), 'targetAttribute' => ['schule' => 'SchulId']],
            [['training'], 'exist', 'skipOnError' => true, 'targetClass' => Trainings::className(), 'targetAttribute' => ['training' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'datum' => Yii::t('app', 'Datum'),
            'training' => Yii::t('app', 'Training'),
            'schule' => Yii::t('app', 'Schule'),
            'mitglied' => Yii::t('app', 'Mitglied'),
        ];
    }

    /**
     * Gets query for [[Mitglied0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMitglied0()
    {
        return $this->hasOne(Mitglieder::className(), ['MitgliederId' => 'mitglied']);
    }

    /**
     * Gets query for [[Schule0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchule0()
    {
        return $this->hasOne(Schulen::className(), ['SchulId' => 'schule']);
    }

    /**
     * Gets query for [[Training0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTraining0()
    {
        return $this->hasOne(Trainings::className(), ['id' => 'training']);
    }
}
