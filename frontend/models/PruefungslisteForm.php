<?php
namespace frontend\models;

use frontend\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class PruefungslisteForm extends Model
{
//    public $username;
    public $datum;
    public $pgeb;
    public $disp;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['pgeb', 'required'],
            ['pgeb', 'number', 'min' => 20, 'max' => 255, 'message' => 'Die Lehrgangsgebühr muss eine Zahl zwischen 20 und 255 sein.'],

            ['datum', 'required'],
            ['datum', 'date'],

            ['disp', 'required'],
            ['disp', 'string', 'max' => 30],
        ];
    }

    public function attributeLabels()
    {
        return [
            'pgeb' => Yii::t('app', 'Lehrgangsgebühr'),
            'datum' => Yii::t('app', 'Tag der Prüfung'),
            'disp' => Yii::t('app', 'Disziplin'),
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
