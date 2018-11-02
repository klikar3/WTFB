<?php

namespace frontend\models;

use Yii;
use yii\helpers\VarDumper;
use yii\helpers\Html;
use yii\helpers\Url;
//use dektrium\user\models\User;

use frontend\models\Grade;
use frontend\models\User;


/**
 * This is the model class for table "mitgliederliste".
 *
 * @property integer $MitgliederId
 * @property string $MitgliedsNr
 * @property string $Vorname
 * @property string $Nachname
 * @property string $Name
 * @property string $Schulname
 * @property string $LeiterName
 * @property string $DispName
 */
class Mitgliederliste extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mitgliederliste';
    }

    public static function primaryKey()
		{
		    return ['MitgliederId'];
		    
		    // For composite primary key, return an array like the following
		    // return array('pk1', 'pk2');
		}
		
    public static function find()
    { 
			if (!Yii::$app->user->identity->isAdmin /*role == 10*/) {
    			$schulleiter = Schulleiter::find()->where(['LeiterId' => Yii::$app->user->identity->LeiterId])->one();
    	    $schulids =  Schulleiterschulen::find()->select(['SchulId'])->where(['LeiterId' => Yii::$app->user->identity->LeiterId]);
          $schulen = Schulen::find()->select(['Schulname'])->where( ['in', 'SchulId', $schulids]);
					Yii::Warning($schulids);
//		    	return parent::find()->where( ['LeiterName' => $schulleiter->LeiterName]);
//		    	return parent::find()->where( ['in', 'SchulId', $schulids]);
		    	return parent::find()->where( ['in', 'Schulname', $schulen]);
		  }
		  return parent::find();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MitgliederId', 'PruefungZum', 'MitgliedsNr'], 'integer'],
            [['MitgliederId', 'MitgliedsNr', 'Schulname', 'LeiterName', 'DispName'], 'required'],
            [['Vorname'], 'string', 'max' => 18],
            [['Nachname'], 'string', 'max' => 29],
            [['Name'], 'string', 'max' => 49],
            [['NameLink'], 'string', 'max' => 49],
            [['NameLink'], 'safe'],
            [['Schulname'], 'string', 'max' => 50],
            [['LeiterName'], 'string', 'max' => 80],
            [['DispName'], 'string', 'max' => 30],
            [['Vertrag'], 'string', 'max' => 50],
            [['LetzteAenderung', 'LetztAendSifu'], 'date', 'format' => 'php:Y-m-d'],
            [['LetzteAenderung', 'LetztAendSifu'], 'safe'],
            [['GeburtsDatum', 'GeburtsDatum'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MitgliederId' => Yii::t('app', 'Mitglieder ID'),
            'MitgliedsNr' => Yii::t('app', 'Mitglieds Nr'),
            'Vorname' => Yii::t('app', 'Vorname'),
            'Nachname' => Yii::t('app', 'Nachname'),
            'Name' => Yii::t('app', 'Name'),
            'NameLink' => Yii::t('app', 'Name'),
            'Schulname' => Yii::t('app', 'Schule'),
            'LeiterName' => Yii::t('app', 'Schulleiter'),
            'DispName' => Yii::t('app', 'Disziplin'),
            'Vertrag' => Yii::t('app', 'Verträge'),
            'PruefungZum' => Yii::t('app', ' '),
            'Grad' => Yii::t('app', 'Grade'),
            'Funktion' => Yii::t('app', 'Funktion'),
            'LetzteAenderung' => Yii::t('app', 'Letzte Änderung'),
            'LetztAendSifu' => Yii::t('app', 'Letzte Änderung Sifu'),
            'GeburtsDatum' => Yii::t('app', 'Geburtsdatum'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitgliederdisziplinens()
    {
        return $this->hasMany(Mitgliederdisziplinen::className(), ['MitgliedId' => 'MitgliederId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitgliedergrades()
    {
        return $this->hasMany(Mitgliedergrade::className(), ['MitgliedId' => 'MitgliederId']);
    }
 
	   /** 
	    * @return \yii\db\ActiveQuery 
	    */ 
	   public function getMitgliederschulens() 
	   { 
	       return $this->hasMany(Mitgliederschulen::className(), ['MitgliederId' => 'MitgliederId']); 
	   } 

	   /** 
	    * @return \yii\db\ActiveQuery 
	    */ 
	   public function getDisp() 
	   { 
	       return $this->hasMany(Disziplinen::className(), ['DispName' => 'DispName']); 
	   } 

	   public function getMitglieder() 
	   { 
	       return $this->hasOne(Mitglieder::className(), ['MitgliederId' => 'MitgliederId']); 
	   } 
	   
	   public function getNameLink() {
		    $url = Url::to(['/mitglieder/view', 'id'=>$this->MitgliederId, 'tabnum' => 1]); // your url code to retrieve the profile view
		    $options = []; // any HTML attributes for your link
		    return Html::a($this->Name, $url, $options); // assuming you have a relation called profile
		}

	   public function getPGeb() {
	   		if (empty($this->PruefungZum)) return '0';
        $grade = Grade::findOne($this->PruefungZum);//->andWhere('gradId', $this->PruefungZum );
//        ->andWhere('Gebuehr > :PruefungZum', ['PruefungZum' => 0])
//				->orderBy('gradId')->one();
//						;//->limit(1)->one();
//        foreach ($grade as $grad) {
//				VarDumper::dump($grad);
//				  };
        if (empty($grade->Gebuehr)) return '0';
		    return $grade->Gebuehr; 
		}

	   public function getPZum() {
	   		if (empty($this->PruefungZum)) return ' ';
        $grade = Grade::findOne($this->PruefungZum);//->andWhere('gradId', $this->PruefungZum );
//        ->andWhere('Gebuehr > :PruefungZum', ['PruefungZum' => 0])
//				->orderBy('gradId')->one();
//						;//->limit(1)->one();
//        foreach ($grade as $grad) {
//				VarDumper::dump($grad);
//				  };
        if (empty($grade->gKurz)) return ' ';
		    return $grade->gKurz; 
		}

}

