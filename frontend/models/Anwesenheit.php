<?php

namespace frontend\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "anwesenheit".
 *
 * @property int $id
 * @property int $trainingsId
 * @property string $datum
 * @property int $anzahl
 * 
* @property Trainings $trainings 
*/
class Anwesenheit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anwesenheit';
    }

    public static function find()
    { 
			if ((!Yii::$app->user->identity->isAdmin /*role == 10*/) /*and (Yii::$app->controller->action->id != 'schuelerzahlen')*/) {
    			$schulleiter = Schulleiter::find()->where(['LeiterId' => Yii::$app->user->identity->LeiterId])->one();
    	    $schulleiterschulen = Schulleiterschulen::find()->select('SchulId')->where(['LeiterId' => $schulleiter->LeiterId])->all();
          $schulen = array_map(function ($v) { return $v->SchulId; },$schulleiterschulen );
          if ((Yii::$app->user->identity->username == 'evastgt') and ((Yii::$app->controller->action->id == 'schuelerzahlen') or (Yii::$app->controller->action->id == 'sektionsliste'))) {
            if (!in_array(18, $schulen)) {
              $schulen = array_merge([18], $schulen);
            }  
            if (!in_array(33, $schulen)) {
              $schulen = [33] + $schulen;
            }  
//Vardumper::dumpAsString($schulen);
          }
//          $trainings = Trainings::find()->select('id')->where(['schulId' => $schulen])->all();
//					Yii::warning("-----PRINT: ". Vardumper::dumpAsString($trainings));
	//				Yii::warning("-----PRINT: ". Vardumper::dumpAsString($schulen));
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString(array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )));
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString(parent::find()->where( ['SchulId' => array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )])->all()));
		    	return parent::find()->innerJoin('trainings',true);
		  }
		  return parent::find();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trainingsId', 'datum', 'anzahl'], 'required'],
            [['trainingsId', 'anzahl'], 'integer'],
            [['datum'], 'safe'],
            [['trainingsId'], 'exist', 'skipOnError' => true, 'targetClass' => Trainings::className(), 'targetAttribute' => ['trainingsId' => 'id']], 
	        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trainingsId' => Yii::t('app', 'Trainings ID'),
            'datum' => Yii::t('app', 'Datum'),
            'anzahl' => Yii::t('app', 'Anzahl'),
        ];
    }
 
		   /** 
		    * @return \yii\db\ActiveQuery 
		    */ 
		   public function getTrainings() 
		   { 
		       return $this->hasOne(Trainings::className(), ['id' => 'trainingsId']); 
		   } 

}
