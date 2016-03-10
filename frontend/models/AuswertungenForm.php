<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class AuswertungenForm extends Model
{
//    public $username;
    public $schule;
    public $von;
    public $bis;
//    public $disp;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['schule','von','bis'], 'required'],
            [['von','bis'], 'date'],
            
//            ['disp', 'required'],
//            ['disp', 'string', 'max' => 30],
        ];
    }

    public function attributeLabels()
    {
        return [
            '$schule' => Yii::t('app', 'Prüfungsgebühr'),
            '$von' => Yii::t('app', 'Tag der Prüfung'),
            '$bis' => Yii::t('app', 'Disziplin'),
        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
/*    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
            return $user;
        }

        return null;
    }
*/    
}
