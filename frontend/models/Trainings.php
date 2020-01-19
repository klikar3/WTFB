<?php

namespace frontend\models;

use Yii;

use frontend\models\Schulen;

/**
 * This is the model class for table "trainings".
 *
 * @property int $id
 * @property int $schulId
 * @property string $description
 *
 * @property Schulen $schul
 */
class Trainings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trainings';
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
//					Yii::warning("-----PRINT: ". Vardumper::dumpAsString($schulleiterschulen));
	//				Yii::warning("-----PRINT: ". Vardumper::dumpAsString($schulen));
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString(array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )));
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString(parent::find()->where( ['SchulId' => array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )])->all()));
		    	return parent::find()->where( ['schulId' => $schulen]);
		  }
		  return parent::find();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['schulId', 'description'], 'required'],
            [['schulId'], 'integer'],
            [['description'], 'string', 'max' => 45],
            [['schulId'], 'exist', 'skipOnError' => true, 'targetClass' => Schulen::className(), 'targetAttribute' => ['schulId' => 'SchulId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'schulId' => Yii::t('app', 'Schul ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchul()
    {
        return $this->hasOne(Schulen::className(), ['SchulId' => 'schulId']);
    }
}
