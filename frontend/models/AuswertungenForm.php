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
    public $fon;
    public $ia;
    public $pt;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['schule'], 'required'],
            [['von','bis'], 'date'],
            [['fon', 'ia', 'pt'], 'integer'],
//            ['disp', 'string', 'max' => 30],
        ];
    }

    public function attributeLabels()
    {
        return [
            '$schule' => Yii::t('app', 'Prüfungsgebühr'),
            '$von' => Yii::t('app', 'Tag der Prüfung'),
            '$bis' => Yii::t('app', 'Disziplin'),
            '$fon' => Yii::t('app', 'TelefonNr vorh.'),
            '$ia' => Yii::t('app', 'Infoabend'),
            '$pt' => Yii::t('app', 'Probetraining'),
        ];
    }
   
}
