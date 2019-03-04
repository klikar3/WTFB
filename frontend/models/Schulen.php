<?php

namespace frontend\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "schulen".
 *
 * @property string $SchulId
 * @property string $Schulname
 * @property integer $sort
 * @property string $Disziplin
 *
 * @property Disziplinen $disziplin 
 * @property Texte[] $textes 
 * @property Mitgliederschulen[] $mitgliederschulens
 * @property Schulleiterschulen[] $schulleiterschulens
 */
class Schulen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schulen';
    }

    public static function find()
    { 
			if ((!Yii::$app->user->identity->isAdmin /*role == 10*/) /*and (Yii::$app->controller->action->id != 'schuelerzahlen')*/) {
    			$schulleiter = Schulleiter::find()->where(['LeiterId' => Yii::$app->user->identity->LeiterId])->one();
    	    $schulleiterschulen = Schulleiterschulen::find()->where(['LeiterId' => $schulleiter->LeiterId])->all();
          $schulen = array_map(function ($v) { return $v->SchulId; },$schulleiterschulen );
          if ((Yii::$app->controller->action->id == 'schuelerzahlen') and (Yii::$app->user->identity->username == 'evastgt')) {
            $schulen = [18 => "Stuttgart K"] + $schulen;
          }
          if ((Yii::$app->controller->action->id == 'sektionsliste') and (Yii::$app->user->identity->username == 'evastgt')) {
            $schulen = [18 => "Stuttgart"] + $schulen;
          }
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString($schulleiterschulen));
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString(array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )));
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString(parent::find()->where( ['SchulId' => array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )])->all()));
		    	return parent::find()->where( ['schulen.SchulId' => $schulen]);
		  }
		  return parent::find();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Schulname', 'sort', 'Disziplin'], 'required'],
            [['sort', 'Disziplin'], 'integer'],
            [['Schulname'], 'string', 'max' => 50],
            [['Disziplin'], 'string', 'max' => 30],
            [['Disziplin', 'Schulname'], 'unique', 'targetAttribute' => ['Disziplin', 'Schulname'], 'message' => 'The combination of Schulname and Disziplin has already been taken.'],
		        [['Disziplin'], 'exist', 'skipOnError' => true, 'targetClass' => Disziplinen::className(), 'targetAttribute' => ['Disziplin' => 'DispId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SchulId' => Yii::t('app', 'Schul ID'),
            'Schulname' => Yii::t('app', 'Schulname'),
            'sort' => Yii::t('app', 'Sort'),
            'Disziplin' => Yii::t('app', 'Disziplin'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitgliederschulens()
    {
        return $this->hasMany(Mitgliederschulen::className(), ['SchulId' => 'SchulId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchulleiterschulens()
    {
        return $this->hasMany(Schulleiterschulen::className(), ['SchulId' => 'SchulId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDisziplinen()
    {
        return $this->hasOne(Disziplinen::className(), ['DispId' => 'Disziplin']);
    }
    
    public function getSchulDisp() {
		    return $this->Schulname . ' ' . $this->disziplinen->DispKurz; // assuming you have a relation called profile
		}

		public function getDisziplin() 
		   { 
		       return $this->hasOne(Disziplinen::className(), ['DispId' => 'Disziplin']); 
		   } 
		 
		public function getTextes()
		   {
      		 return $this->hasMany(Texte::className(), ['SchulId' => 'SchulId']);
		   }
}
