<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "swmreceiver".
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $anrede
 * @property string|null $vorname
 * @property string|null $nachname
 * @property string|null $geburtstag
 * @property string|null $geschlecht
 */
class Swmreceiver extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'swmreceiver';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'anrede', 'vorname', 'nachname'], 'string', 'max' => 100],
            [['geburtstag', 'geschlecht'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'anrede' => Yii::t('app', 'Anrede'),
            'vorname' => Yii::t('app', 'Vorname'),
            'nachname' => Yii::t('app', 'Nachname'),
            'geburtstag' => Yii::t('app', 'Geburtstag'),
            'geschlecht' => Yii::t('app', 'Geschlecht'),
        ];
    }
}
