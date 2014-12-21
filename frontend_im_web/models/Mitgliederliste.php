<?php

namespace frontend\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

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
		
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MitgliederId'], 'integer'],
            [['MitgliederId', 'MitgliedsNr', 'Schulname', 'LeiterName', 'DispName'], 'required'],
            [['MitgliedsNr'], 'string', 'max' => 6],
            [['Vorname'], 'string', 'max' => 18],
            [['Nachname'], 'string', 'max' => 29],
            [['Name'], 'string', 'max' => 49],
            [['Schulname'], 'string', 'max' => 50],
            [['LeiterName'], 'string', 'max' => 80],
            [['DispName'], 'string', 'max' => 30],
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
}

