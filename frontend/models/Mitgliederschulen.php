<?php

namespace frontend\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\helpers\Url;

/**
 * This is the model class for table "mitgliederschulen".
 *
 * @property string $msID
 * @property integer $MitgliederId
 * @property string $SchulId
 * @property string $Von
 * @property string $Bis
 * @property string $VertragId
 * @property string $VDauerMonate 
 * @property string $MonatsBeitrag 
 * @property string $ZahlungsArt 
 * @property string $Zahlungsweise 
 * @property string $BeitragAussetzenVon 
 * @property string $BeitragAussetzenBis 
 * @property string $BeitragAussetzenGrund 
 * @property string $KuendigungAm 
 *
 * @property Mitglieder $mitglieder 
 * @property Schulen $schul
 * @property Mitglieder $mitglieder
 * @property Vertrag $vertrag
 */
class Mitgliederschulen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mitgliederschulen';
    }

    public static function find()
    { 
			if (!Yii::$app->user->identity->isAdmin /*role == 10*/) {
		    	$schulleiter = Schulleiter::find()->where(['LeiterId' => Yii::$app->user->identity->LeiterId])->one();
		    	
					// VarDumper::dump($schulleiter);
					$schulleiterschulen = Schulleiterschulen::find()->where(['LeiterId' => Yii::$app->user->identity->LeiterId])->all();
					// Yii::info('-----$schulleiterschulen: '.VarDumper::dumpAsString($schulleiterschulen),'application');
					$si = array_map(function ($v) { return $v->SchulId; },$schulleiterschulen );
					// Yii::info('-----$s: '.VarDumper::dumpAsString($si));
					
//					if (empty($schulleiterschulen)) return [];
//					$schulen = Schulen::findAll(['SchulId' => $si]);
//					Yii::info('-----$schulen: '.VarDumper::dump($schulen));
//					$schule = Schulen::find()->all(); //where(['schulId' => array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )])->all();
//					$disziplin = Disziplinen::find()->where(['DispId' => $schule->Disziplin])->one();
//		    	return parent::find()->where( ['Schulort' => $schule->Schulname,'Disziplin' => $disziplin->DispName ]);
//					return parent::find()->where( ['SchulId' => $si]);
					$r = parent::find()->where( ['SchulId' => $si]);
					// Yii::info('-----$r: '.VarDumper::dumpAsString($r));
					
		    	return (!empty($r)) ? $r : [] ;
		  }
		  return parent::find();
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           [['MitgliederId', 'SchulId', 'VDatum', 'Von', 'VDauerMonate', 'MonatsBeitrag', 'ZahlungsArt', 'Zahlungsweise'], 'required'],
	         [['MitgliederId', 'SchulId', 'VertragId', 'VDauerMonate'], 'integer'],
	         [['Von', 'Bis', 'BeitragAussetzenVon', 'BeitragAussetzenBis', 'KuendigungAm', 'AGbezahltAm', 'VertragId', 'VDatum', 'WM', 'SF', 'BV', 'BL', 'OK'], 'safe'],
	         [['MonatsBeitrag','AGebuehr'], 'number'],
	         [['ZahlungsArt', 'Zahlungsweise'], 'string', 'max' => 20],
	         [['BeitragAussetzenGrund'], 'string', 'max' => 45],
	         [['MitgliederId'], 'exist', 'skipOnError' => true, 'targetClass' => Mitglieder::className(), 'targetAttribute' => ['MitgliederId' => 'MitgliederId']],
	         [['SchulId'], 'exist', 'skipOnError' => true, 'targetClass' => Schulen::className(), 'targetAttribute' => ['SchulId' => 'SchulId']],
	         [['VertragId'], 'exist', 'skipOnError' => true, 'targetClass' => Vertrag::className(), 'targetAttribute' => ['VertragId' => 'VertragId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'msID' => Yii::t('app', 'a'),
            'MitgliederId' => Yii::t('app', 'Mitglieder ID'),
            'SchulId' => Yii::t('app', 'Schule'),
						'VDatum' => Yii::t('app', 'V-Datum'),
            'Von' => Yii::t('app', 'Eintritt'),
            'Bis' => Yii::t('app', 'Austritt'),
            'VertragId' => Yii::t('app', 'Vertrag (.pdf)'),
						'KuendigungAm' => Yii::t('app', 'Kündigung'),
						'VDauerMonate' => Yii::t('app', 'V-Dauer'),
						'MonatsBeitrag' => Yii::t('app', 'Beitrag'),
						'ZahlungsArt' => Yii::t('app', 'Z-Art'), 
						'Zahlungsweise' => Yii::t('app', 'Z-Weise'),
						'BeitragAussetzenVon' => Yii::t('app', 'Aussetzen ab'), 
						'BeitragAussetzenBis' => Yii::t('app', 'Aussetzen bis'), 
						'BeitragAussetzenGrund' => Yii::t('app', 'Aussetzen Grund'),
						'AGebuehr' => Yii::t('app', 'Aufnahmegebühr'),
						'AGbezahltAm' => Yii::t('app', 'AG bezahlt am'),
						'BV' => Yii::t('app', 'BE'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchul()
    {
        return $this->hasOne(Schulen::className(), ['SchulId' => 'SchulId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMitglieder()
    {
        return $this->hasOne(Mitglieder::className(), ['MitgliederId' => 'MitgliederId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMgl()
    {
        return $this->hasOne(Mitgliederliste::className(), ['MitgliederId' => 'MitgliederId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVertrag()
    {
        return $this->hasOne(Vertrag::className(), ['VertragId' => 'VertragId']);
    }
    
	   public function getNameLink() {
		    $url = Url::to(['/mitglieder/view', 'id'=>$this->MitgliederId, 'tabnum' => 1]); // your url code to retrieve the profile view
		    $options = []; // any HTML attributes for your link
		    return Html::a($this->mitglieder->Name . ', ' . $this->mitglieder->Vorname, $url, $options); // assuming you have a relation called profile
		}

}
