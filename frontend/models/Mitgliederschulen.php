<?php

namespace frontend\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\helpers\Url;
use yii\db\ActiveQuery;
use yii\db\Expression;

use IBAN\Validation\IBANValidator;
use IBAN\Generation\IBANGenerator;
use IBAN\Generation\IBANGeneratorDE;
use IBAN\Rule\RuleFactory;

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
 * @property string $kFristMonate
* @property integer $WtfbOk
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
//		    	$schulleiter = Schulleiter::find()->where(['LeiterId' => Yii::$app->user->identity->LeiterId])->one();
		    	
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
					$r = parent::find()->where( ['mitgliederschulen.SchulId' => $si]);
					// Yii::info('-----$r: '.VarDumper::dumpAsString($r));
					
		    	return (!empty($r)) ? $r : [] ;
		  }
		  return parent::find();
    }


		public function checkIBAN($iban) {
		
			// Normalize input (remove spaces and make upcase)
			$iban = strtoupper(str_replace(' ', '', $iban));
			
			if (preg_match('/^[A-Z]{2}[0-9]{2}[A-Z0-9]{1,30}$/', $iban)) {
			    $country = substr($iban, 0, 2);
			    $check = intval(substr($iban, 2, 2));
			    $account = substr($iban, 4);
			
			    // To numeric representation
			    $search = range('A','Z');
			    foreach (range(10,35) as $tmp)
			        $replace[]=strval($tmp);
			    $numstr=str_replace($search, $replace, $account.$country.'00');
			
			    // Calculate checksum
			    $checksum = intval(substr($numstr, 0, 1));
			    for ($pos = 1; $pos < strlen($numstr); $pos++) {
			        $checksum *= 10;
			        $checksum += intval(substr($numstr, $pos,1));
			        $checksum %= 97;
			    }
			
			    return ((98-$checksum) == $check);
			} else
			    return false;
		}
		
					
		public function validateIban($model, $attribute) 
		{
				if (empty($attribute)) return;
//				Yii::warning('----- $attribute: '.VarDumper::dumpAsString($attribute));
//			  Yii::warning('----- $model->$attribute: '.VarDumper::dumpAsString($model->$attribute));
				// validation 
				$ibanValidator = new IBANValidator();
				if ($this->checkIBAN($attribute) and $ibanValidator->validate($model->$attribute)) {
//			  		Yii::warning('----- validtate ok: '.VarDumper::dumpAsString($model->$attribute));
						return;
				}
				$this->addError($attribute, 'IBAN is not valid!');
		}    

		public function generateIban($attribute, $params) 
		{
				if (empty($attribute)) return;
			  if (empty($this->KontoNr) or empty($this->BLZ)) return;
				// validation 
				$ibanGenerator = new IBANGeneratorDE();
//				Yii::info('-----gen  $KontoNr: '.VarDumper::dumpAsString($this->KontoNr));
//				Yii::info('-----gen $BLZ: '.VarDumper::dumpAsString($this->BLZ));
				$generatedIban = $ibanGenerator->generate($this->BLZ, $this->KontoNr);
//				Yii::info('-----gen $generatedIban: '.VarDumper::dumpAsString($generatedIban));
				if (!empty($generatedIban)) {
						$ibanValidator = new IBANValidator();
						if ($this->checkIBAN($generatedIban) and $ibanValidator->validate($generatedIban)) {
//						Yii::warning('-----gen $generatedIban valid: '.VarDumper::dumpAsString($generatedIban));
								$this->IBAN = $generatedIban;
								$attribute = $generatedIban;
								return;
						}
//						Yii::warning('-----gen $generatedIban invalid '.VarDumper::dumpAsString($generatedIban));
				}
				$this->addError($attribute, 'Resulting IBAN is not valid!');
		}    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           [['MitgliederId', 'SchulId', 'VDatum', 'Von', 'VDauerMonate', 'MonatsBeitrag', 'ZahlungsArt', 'Zahlungsweise', 'KFristMonate'], 'required'],
	         [['MitgliederId', 'SchulId', 'VertragId', 'VDauerMonate', 'KFristMonate', 'WtfbOk', 'VerlaengerungMonate'], 'integer'],
	         [['Von', 'Bis', 'BeitragAussetzenVon', 'BeitragAussetzenBis', 'KuendigungAm', 'AGbezahltAm', 'VertragId', 'VDatum', 'WtfbOk', 'SF', 'BV', 'BL', 'OK'], 'safe'],
           [['VDatum', 'KuendigungAm', 'AGbezahltAm', 'BeitragAussetzenVon', 'BeitragAussetzenBis', 'mandatDatum'],'date', 'format' => 'php:Y-m-d'],
		       [['IBAN'], 'validateIban', 'skipOnEmpty' => true, 'skipOnError' => false],
					 [['Bank'], 'string', 'max' => 100],
           [['mandatNr'], 'string', 'max' => 30], 
           [['Kontoinhaber'], 'string', 'max' => 31],
           [['IBAN'], 'string', 'max' => 26],
	         [['BIC'], 'string', 'max' => 11],            
	         [['MonatsBeitrag','AGebuehr'], 'number'],
	         [['ZahlungsArt', 'Zahlungsweise'], 'string', 'max' => 20],
	         [['BeitragAussetzenGrund'], 'string', 'max' => 45],
	         [['KuendigungGrund'], 'string', 'max' => 500],
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
						'Bank' => Yii::t('app', 'Bank'),
						'IBAN' => Yii::t('app', 'IBAN'),
						'BIC' => Yii::t('app', 'BIC'),
						'Kontoinhaber' => Yii::t('app', 'Kontoinhaber'),
						'mandatNr' => Yii::t('app', 'Mandat-Nr'),
						'mandatDatum' => Yii::t('app', 'Mandat-Datum'),
            'KuendigungGrund' => Yii::t('app', 'KuendigungGrund'),
            'KFristMonate' => Yii::t('app', 'Kündigungsfrist'),
            'WtfbOk' => Yii::t('app', 'WTFB'),
            'VerlaengerungMonate' => Yii::t('app', 'V-Verlängerung'),
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
