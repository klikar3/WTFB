<?php

namespace frontend\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "schulen".
 *
 * @property int $SchulId
 * @property string $Schulname
 * @property int $sort
 * @property int $Disziplin
 * @property int $swmInteressentenListe
 * @property int $swmInteressentenForm
 * @property int $swmMitgliederListe
 * @property int $swmMitgliederForm
 *
 * @property Disziplinen $disziplin 
 * @property Mitgliederschulen[] $mitgliederschulens
 * @property Schulleiterschulen[] $schulleiterschulens
 * @property Texte[] $textes 
 * @property Trainings[] $trainings 
 */
class Schulen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schulen';
    }

    public static function find()
    { 
			if ((!Yii::$app->user->identity->isAdmin /*role == 10*/) /*and (Yii::$app->controller->action->id != 'schuelerzahlen')*/) {
    			$schulleiter = Schulleiter::find()->where(['LeiterId' => Yii::$app->user->identity->LeiterId])->one();
    	    $schulleiterschulen = Schulleiterschulen::find()->select('SchulId')->where(['LeiterId' => $schulleiter->LeiterId])->all();
//					Yii::warning( Vardumper::dumpAsString($schulleiterschulen));
          $schulen = array_map(function ($v) { return $v->SchulId; },$schulleiterschulen );
//					Yii::warning("-----schulen: ". Vardumper::dumpAsString($schulen));
          if ((Yii::$app->user->identity->username == 'evastgt') and ((Yii::$app->controller->action->id == 'schuelerzahlen') or (Yii::$app->controller->action->id == 'sektionsliste'))) {
            if (!in_array(18, $schulen)) {
              $schulen = array_merge([18], $schulen);
//              Yii::warning("-----eva:18 ");
            }  
            if (!in_array(33, $schulen)) {
              $schulen = [33] + $schulen;
//              Yii::warning("-----eva:33 ");
            }  

//            $schulen = [18 => "Stuttgart K"] + $schulen;
//Vardumper::dumpAsString($schulen);
          }
//					Yii::warning("-----PRINT: ". Vardumper::dumpAsString($schulleiterschulen));
	//				Yii::warning("-----PRINT: ". Vardumper::dumpAsString($schulen));
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString(array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )));
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString(parent::find()->where( ['SchulId' => array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )])->all()));
		    	return parent::find()->where( ['schulen.SchulId' => $schulen]);
		  }
		  return parent::find();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Schulname', 'sort', 'Disziplin'], 'required'],
            [['sort', 'Disziplin', 'swmInteressentenListe', 'swmInteressentenForm', 'swmMitgliederListe', 'swmMitgliederForm'], 'integer'],
            [['Schulname'], 'string', 'max' => 50],
            [['Disziplin'], 'string', 'max' => 30],
            [['Schulname', 'Disziplin'], 'unique', 'targetAttribute' => ['Schulname', 'Disziplin'], 'message' => 'The combination of Schulname and Disziplin has already been taken.'],
            [['Disziplin'], 'exist', 'skipOnError' => true, 'targetClass' => Disziplinen::className(), 'targetAttribute' => ['Disziplin' => 'DispId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SchulId' => Yii::t('app', 'School ID'),
            'Schulname' => Yii::t('app', 'School name'),
            'sort' => Yii::t('app', 'Sort'),
            'Disziplin' => Yii::t('app', 'Disciplin'),
            'swmInteressentenListe' => Yii::t('app', 'Swm Interessent List'), 
            'swmInteressentenForm' => Yii::t('app', 'Swm Interessent Form'), 
            'swmMitgliederListe' => Yii::t('app', 'Swm Member Liste'), 
            'swmMitgliederForm' => Yii::t('app', 'Swm Member Form'), 
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
            $disp = $this->getDisziplinen();
		    return $this->Schulname . ' ' . $disp->DispKurz; // assuming you have a relation called profile
		}

		public function getDisziplin() 
		   { 
		       return $this->hasOne(Disziplinen::className(), ['DispId' => 'Disziplin']); 
		   } 
		 
		public function getTextes()
		   {
      		 return $this->hasMany(Texte::className(), ['SchulId' => 'SchulId']);
		   }
       
    public function getTrainings()
		  {
		      return $this->hasMany(Trainings::className(), ['schulId' => 'SchulId']);
		  }
	   
}
