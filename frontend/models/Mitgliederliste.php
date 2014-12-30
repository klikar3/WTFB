<?php

namespace frontend\models;

use Yii;
use yii\helpers\VarDumper;
use yii\helpers\Html;
use yii\helpers\Url;
use dektrium\user\models\User;

use frontend\models\Grade;


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
 * @property integer $PruefungZum
 * @property string $Grad
 * @property string $Funktion
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
    	
					// VarDumper::dump($schulleiter);
		    	return parent::find()->where( ['LeiterName' => $schulleiter->LeiterName]);
		  }
		  return parent::find();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MitgliederId', 'PruefungZum'], 'integer'],
            [['MitgliederId', 'MitgliedsNr', 'Schulname', 'LeiterName', 'DispName'], 'required'],
            [['MitgliedsNr'], 'string', 'max' => 6],
            [['Vorname'], 'string', 'max' => 18],
            [['Nachname'], 'string', 'max' => 29],
            [['Name'], 'string', 'max' => 49],
            [['NameLink'], 'string', 'max' => 49],
            [['Schulname'], 'string', 'max' => 50],
            [['LeiterName'], 'string', 'max' => 80],
            [['DispName','Grad','Funktion'], 'string', 'max' => 30],
            [['Vertrag'], 'string', 'max' => 50],
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
            'PruefungZum' => Yii::t('app', 'P. zum'),
            'Grad' => Yii::t('app', 'Grade'),
            'Funktion' => Yii::t('app', 'Funktion'),
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
	   
	   public function getNameLink() {
		    $url = Url::to(['/mitglieder/view', 'id'=>$this->MitgliederId]); // your url code to retrieve the profile view
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

