<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "swm_blocked_emails".
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $datum
 */
class SwmBlockedEmails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'swm_blocked_emails';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['datum'], 'safe'],
            [['email'], 'string', 'max' => 100],
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
            'datum' => Yii::t('app', 'Datum'),
        ];
    }
}
