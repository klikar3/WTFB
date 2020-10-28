<?php

namespace frontend\models;

use Yii;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "pruefer".
 *
 * @property int $prueferId
 * @property string $pName
 * @property int $sort
 *
 * @property Mitgliedergrade[] $mitgliedergrades
 */
class Pruefer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pruefer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prueferId', 'pName', 'sort'], 'required'],
            [['prueferId', 'sort'], 'integer'],
            [['pName'], 'string', 'max' => 50]
        ];
    }

    public static function find()
    { 
			if (!Yii::$app->user->identity->isAdmin /*role == 10*/) {
		    	$schulleiter = Schulleiter::find()->select('LeiterName')->where(['LeiterId' => Yii::$app->user->identity->LeiterId])->orWhere(['LeiterName' => 'Sifu Niko'])->all();
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString($schulleiter));
					// VarDumper::dump($schulleiter);
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString($schulleiterschulen));
		    	return parent::find()->where( ['pName' => array_map(function ($v) { return $v->LeiterName; },$schulleiter )]);
//					return parent::find()->andWhere( ['or', ['mitglieder.SchulId' => $si]]);
		  }
		  return parent::find();
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prueferId' => Yii::t('app', 'Pruefer ID'),
            'pName' => Yii::t('app', 'P Name'),
            'sort' => Yii::t('app', 'Sort'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitgliedergrades()
    {
        return $this->hasMany(Mitgliedergrade::className(), ['PrueferId' => 'prueferId']);
    }
}
