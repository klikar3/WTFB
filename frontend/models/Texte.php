<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "texte".
 *
 * @property string $id
 * @property string $SchulId
 * @property string $code
 * @property string $fuer
 * @property string $txt
 * @property string $betreff 
 * @property integer $quer 
 * *
 * @property Schulen $schul
 */
class Texte extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'texte';
    }

    public static function find()
    { 
			if (!Yii::$app->user->identity->isAdmin /*role == 10*/) {
    			$schulleiter = Schulleiter::find()->where(['LeiterId' => Yii::$app->user->identity->LeiterId])->one();
    	    $schulleiterschulen = Schulleiterschulen::find()->where(['LeiterId' => $schulleiter->LeiterId])->all();
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString($schulleiterschulen));
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString(array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )));
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString(parent::find()->where( ['SchulId' => array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )])->all()));
		    	return parent::find()->where( ['SchulId' => array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )]);
		  }
		  return parent::find();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SchulId', 'quer'], 'integer'],
            [['code', 'fuer', 'txt'], 'required'],
            [['txt'], 'string'],
            [['code'], 'string', 'max' => 50],
            [['fuer', 'betreff'], 'string', 'max' => 99],
            [['SchulId'], 'exist', 'skipOnError' => true, 'targetClass' => Schulen::className(), 'targetAttribute' => ['SchulId' => 'SchulId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'SchulId' => Yii::t('app', 'Schul ID'),
            'code' => Yii::t('app', 'Code'),
            'fuer' => Yii::t('app', 'Fuer'),
            'txt' => Yii::t('app', 'Txt'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchul()
    {
        return $this->hasOne(Schulen::className(), ['SchulId' => 'SchulId']);
    }
}
