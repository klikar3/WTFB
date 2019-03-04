<?php
namespace frontend\models;

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
            [['schule'], 'required'],
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
   
}
