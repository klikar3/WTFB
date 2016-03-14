<?php
namespace frontend\models;

use dektrium\user\models\User as BaseUser;

/*
 * @property integer $LeiterId
 */

class User extends BaseUser
{
    public function register()
    {
        // do your magic
    }
    
    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'LeiterId'          => Yii::t('user', 'LeiterId'),
        ];
    }
    
}