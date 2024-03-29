<?php

namespace frontend\models;

use Yii;
use yii\helpers\VarDumper;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\web\NotFoundHttpException;
//use jschaedl\iban\library\IBAN\Validation\IBANValidator;
/*use IBAN\Validation\IBANValidator;
use IBAN\Generation\IBANGenerator;
use IBAN\Generation\IBANGeneratorDE;
use IBAN\Rule\RuleFactory;
*/
use frontend\models\Intensiv;
use frontend\models\Schulen;


/**
 * This is the model class for table "mitglieder".
 *
 * @property integer $MitgliederId
 * @property string $MitgliedsNr
 * @property string $Vorname
 * @property string $Name
 * @property string $Geschlecht
 * @property string $Anrede
 * @property string $GeburtsDatum
 * @property string $PLZ
 * @property string $Wohnort
 * @property string $Strasse
 * @property string $Telefon1
 * @property string $Telefon2
 * @property string $HandyNr
 * @property string $Fax
 * @property string $LetzteAenderung
 * @property string $Email
 * @property string $Beruf
 * @property string $Nationalitaet
 * @property string $BLZ
 * @property string $Bank
 * @property string $IBAN
 * @property string $KontoNr
 * @property string $Status
 * @property string $AktivPassiv
 * @property string $Kontoinhaber
 * @property string $Schulort
 * @property string $Disziplin
 * @property string $Funktion
 * @property string $Sifu
 * @property string $ErzBerechtigter
 * @property string $Woher
 * @property string $Graduierung
 * @property string $VDauer
 * @property string $Monatsbeitrag
 * @property string $BeitrittDatum
 * @property string $KuendigungDatum
 * @property string $AustrittDatum
 * @property string $Geburtsort
 * @property string $GruppenArt
 * @property string $Zahlungsart
 * @property string $Zahlungsweise
 * @property string $EinzugZum
 * @property string $AufnahmegebuehrBezahlt
 * @property string $EWTONr
 * @property string $EWTOAustritt
 * @property string $BeitragOffenAb
 * @property string $BeitragOffenEuro
 * @property string $BeitragOffenBis
 * @property string $Mahngebuehren
 * @property string $GesamtOffen
 * @property string $Mahnung1Am
 * @property string $Mahnung2Am
 * @property string $Mahnung3Am
 * @property string $BarZahlungAm
 * @property string $InkassoAm
 * @property string $Zahlungsfrist
 * @property string $Bemerkungen
 * @property string $Betreff
 * @property string $Text
 * @property string $KontaktAm
 * @property string $KontaktArt
 * @property string $Bemerkung1
 * @property string $EinladungIAzum
 * @property string $IABest
 * @property string $warZumIAda
 * @property string $zumIAnichtDa
 * @property string $ProbetrainingAm
 * @property string $PTwarDa
 * @property string $zumPTnichtDa
 * @property string $VertragAbgeschlossen
 * @property integer $VertragMit
 * @property string $Abschlussgespraech
 * @property string $Bemerkung2
 * @property string $WTPruefungZum
 * @property string $WTPruefungAm
 * @property string $KPruefungZum
 * @property string $KPruefungAm
 * @property string $EPruefungZum
 * @property string $EPruefungAm
 * @property string $GutscheinVon
 * @property string $Name2Schule
 * @property string $DM2Schule
 * @property string $NeuerBeitrag
 * @property string $Vereinbarung
 * @property string $RechnungsNr
 * @property string $VErgaenzungAb
 * @property string $Land
 * @property string $AussetzenDauer
 * @property string $Betrag
 * @property string $BezahltAm
 * @property string $ZahlungsweiseBetrag
 * @property string $datumwt1sg
 * @property string $datumwt2sg
 * @property string $datumwt3sg
 * @property string $datumwt4sg
 * @property string $datumwt5sg
 * @property string $datumwt6sg
 * @property string $datumwt7sg
 * @property string $datumwt8sg
 * @property string $datumwt9sg
 * @property string $datumwt10sg
 * @property string $datumwt11sg
 * @property string $datumwt12sg
 * @property string $datumwt1tg
 * @property string $datumwt2tg
 * @property string $datumwt3tg
 * @property string $datumwt4tg
 * @property string $datumwt5pg
 * @property string $AufnahmegebuehrBezahltAm
 * @property string $datumWtPraktikum
 * @property string $datumWtAusbilder1
 * @property string $datumWtAusbilder2
 * @property string $datumWtAusbilder3
 * @property string $datumWtSchulleiter
 * @property string $AufnGebuehrBetrag
 * @property integer $SFirm
 * @property string $datumwt1sgk
 * @property string $datumwt2sgk
 * @property string $datumwt3sgk
 * @property string $datumwt4sgk
 * @property string $datumwt5sgk
 * @property string $datumwt6sgk
 * @property string $datumwt7sgk
 * @property string $datumwt8sgk
 * @property string $datumwt9sgk
 * @property string $datumwt10sgk
 * @property string $datumwt11sgk
 * @property string $datumwt12sgk
 * @property string $datume1sg
 * @property string $datume2sg
 * @property string $datume3sg
 * @property string $datume4sg
 * @property string $datume5sg
 * @property string $datume6sg
 * @property string $datume7sg
 * @property string $datume8sg
 * @property string $datume9sg
 * @property string $datume10sg
 * @property string $datume11sg
 * @property string $datume12sg
 * @property integer $BListe
 * @property string $DVDgesendetAm
 * @property string $datume11tg
 * @property string $datume12tg
 * @property string $datume21tg
 * @property string $datume22tg
 * @property string $datume31tg
 * @property string $datume32tg
 * @property string $datume41tg
 * @property string $datume42tg
 * @property string $EsckrimaGraduierung
 * @property string $BeginnEsckrima
 * @property string $EndeEsckrima
 * @property integer $PruefungZum
 *
 * @property string $kontaktNachricht1
 * @property string $LetztAendSifu
 * @property string $RecDeleted
* 
 * @property Mitgliederdisziplinen[] $mitgliederdisziplinens
 * @property Mitgliedergrade[] $mitgliedergrades
 * @property Mitgliederschulen[] $mitgliederschulens 
*/


class Mitglieder extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mitglieder';
        
    }

    public static function find()
    { 
			if (!Yii::$app->user->identity->isAdmin /*role == 10*/) {
		    	$schulleiter = Schulleiter::find()->where(['LeiterId' => Yii::$app->user->identity->LeiterId])->all();
		    	
					// VarDumper::dump($schulleiter);
					$schulleiterschulen = Schulleiterschulen::find()->where(['LeiterId' => Yii::$app->user->identity->LeiterId])->all();
//					 Yii::warning('-----$s: '.VarDumper::dump($schulleiterschulen));
//					$schule = Schulen::find()->all(); //where(['schulId' => array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )])->all();
					$schule = Schulen::find()->where(['schulId' => array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )])->all();
          $si = array_map(function ($v) { return $v->Schulname; }, $schule);
          if ((Yii::$app->user->identity->username == 'evastgt') and ((Yii::$app->controller->action->id == 'schuelerzahlen') or (Yii::$app->controller->action->id == 'sektionsliste'))) {
            if (!in_array('Stuttgart', $si)) $si = ['Stuttgart'] + $si;
          }
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString($schulleiterschulen));
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString($schule));
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString(array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )));
//					Yii::error("-----PRINT: ". Vardumper::dumpAsString(parent::find()->where( ['SchulId' => array_map(function ($v) { return $v->SchulId; },$schulleiterschulen )])->all()));

/*					$si = array_map(function ($v) { return $v->SchulId; }, $schulleiterschulen );
          if ((Yii::$app->user->identity->username == 'evastgt') and ((Yii::$app->controller->action->id == 'schuelerzahlen') or (Yii::$app->controller->action->id == 'sektionsliste'))) {
            if (!in_array(18, $si)) $si = [18] + $si;
            if (!in_array(33, $si)) $si = [33] + $si;
          }
*/          
//					$disziplin = Disziplinen::find()->where(['DispId' => $schule->Disziplin])->one();
//		    	return parent::find()->where( ['Schulort' => $schule->Schulname,'Disziplin' => $disziplin->DispName ]);
		    	return parent::find()->where( ['Schulort' => $si]);
//					return parent::find()->andWhere( ['or', ['mitglieder.SchulId' => $si]]);
		  }
		  return parent::find();
    }

    public static function findModel($id)
    {
        if (($model = Mitglieder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
/*
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

*/
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MitgliederId', 'Vorname', 'Name', 'Schulort', 'Funktion'], 'required'],
            [['Email'], 'email',  'allowName' => true, 'enableIDN' => true, 'enableLocalIDN' => true],
            [['MitgliederId'], 'unique'],
//		        [['IBAN'], 'validateIban', 'skipOnEmpty' => true, 'skipOnError' => false],
//		        [['IBAN'], 'generateIban', 'skipOnEmpty' => false, 'skipOnError' => false],
//		        [['KontoNr', 'BLZ'], 'string', 'min' => 5, 'max' => 10, 'skipOnEmpty' => true],
//		        [['KontoNr', 'BLZ'], 'generateIban', 'skipOnEmpty' => true, 'skipOnError' => false],
//		        [['IBAN'], 'validateIban', 'skipOnEmpty' => true, 'skipOnError' => false],
            [['IABest', 'WarZumIAda', 'PTwarDa', 'VertragMit', 'VertragAbgeschlossen', 'MitgliederId', 'MitgliedsNr', 'VertragMit', 'SFirm', 'BListe', 'PruefungZum'], 'integer'],
            [['BeitrittDatum','GeburtsDatum', 'KuendigungDatum', 'KontaktAm', 'mandatDatum', 'DVDgesendetAm', 'wiederVorlageAm'],'date', 'format' => 'php:Y-m-d'],
            [['LetzteAenderung','LetztAendSifu'],'date', 'format' => 'Y-m-d H:m:s'],
            [['ProbetrainingAm'],'date', 'format' => 'Y-m-d H:m:s'],
//            [['BeitrittDatum','GeburtsDatum', 'KuendigungDatum', 'AustrittDatum', 'ProbetrainingAm', 'KontaktAm'], 'default', 'allowEmpty'=>true, 'value' => null],
           	[['MitgliederId', 'MitgliedsNr', 'SFirm', 'BListe', 'PruefungZum','LetzteAenderung','LetztAendSifu','RecDeleted'], 'safe'],
           	[['Vorname', 'Geschlecht', 'Telefon1', 'Telefon2', 'HandyNr', 'Fax', 'Status', 
						 	'Disziplin', 'Funktion', 'Graduierung'], 'string', 'max' => 20],
            [['Name', 'Betreff', 'mandatNr', 'Schulort'], 'string', 'max' => 30],
            [['Anrede', 'Wohnort', 'Strasse', 'Email', 'Beruf', 'Nationalitaet', 'Sifu', 'ErzBerechtigter'], 'string', 'max' => 50],
		    [['KontaktArt', 'RechnungsNr', 'letzteDvd'], 'string', 'max' => 50],            
            [['PLZ', 'VDauer', 'BeitragOffenBis'], 'string', 'max' => 13],
            [['Mahngebuehren', 'Vereinbarung', 'VErgaenzungAb', 'AufnGebuehrBetrag', 'EsckrimaGraduierung'], 'string', 'max' => 9],
			[['Bank'], 'string', 'max' => 100],
            [['AktivPassiv', 'EWTONr', 'EWTOAustritt', 
							'BeitragOffenEuro', 'GesamtOffen', 'Mahnung3Am', 'EinladungIAzum', 'Abschlussgespraech', 
							'Bemerkung2', 'GutscheinVon', 'NeuerBeitrag', 'Land', 'AussetzenDauer', 'Betrag', 'ZahlungsweiseBetrag'], 'string', 'max' => 10],
            [['Kontoinhaber'], 'string', 'max' => 31],
            [['Woher'], 'string', 'max' => 27],
            [['Bemerkung1'], 'string', 'max' => 512],
            [['Geburtsort','IBAN'], 'string', 'max' => 26],
            [['GruppenArt', 'BeitragOffenAb', 'EPruefungAm', 'BeginnEsckrima', 'EndeEsckrima'], 'string', 'max' => 18], 
	        [['KPruefungZum', 'EPruefungZum'], 'string', 'max' => 12],
	        [['BIC'], 'string', 'max' => 11],            
//						[['Zahlungsweise'], 'string', 'max' => 16], 
		    [['EinzugZum'], 'string', 'max' => 15],
//            [['BeitragAussetzenGrund'], 'string', 'max' => 37],
            [['AufnahmegebuehrBezahlt', 'WTPruefungZum'], 'string', 'max' => 14], 
		    [['Mahnung1Am', 'Mahnung2Am', 'BarZahlungAm', 'InkassoAm', 'Zahlungsfrist', 'WTPruefungAm', 'KPruefungAm', 
							'Name2Schule', 'BezahltAm', 'AufnahmegebuehrBezahltAm'], 'string', 'max' => 19],            
			[['Bemerkungen'], 'string', 'max' => 294],
            [['Text'], 'string', 'max' => 426],
            [['DM2Schule'], 'string', 'max' => 5],
//            [['zumIAnichtDa', 'zumPTnichtDa'], 'string', 'max' => 6],
//		        [['MitgliedsNr'], 'unique']
            [['kontaktNachricht1'], 'string', 'max' => 9999]
		];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MitgliederId' => Yii::t('app', 'MemberID'),
            'MitgliedsNr' => Yii::t('app', 'MemberNo'),
            'Vorname' => Yii::t('app', 'Given name'),
            'Name' => Yii::t('app', 'Name'),
            'Geschlecht' => Yii::t('app', 'Sex'),
            'Anrede' => Yii::t('app', 'Salutation'),
            'GeburtsDatum' => Yii::t('app', 'Birthday'),
            'PLZ' => Yii::t('app', 'PLZ'),
            'Wohnort' => Yii::t('app', 'Place of Residence'),
            'Strasse' => Yii::t('app', 'Street'),
            'Telefon1' => Yii::t('app', 'Phone'),
            'Telefon2' => Yii::t('app', 'Phone2'),
            'HandyNr' => Yii::t('app', 'Mobile No'),
            'Fax' => Yii::t('app', 'Fax'),
            'LetzteAenderung' => Yii::t('app', 'Last Change'),
            'LetztAendSifu' => Yii::t('app', 'Last Change Sifu'),
            'Email' => Yii::t('app', 'Email'),
            'Beruf' => Yii::t('app', 'Job'),
            'Nationalitaet' => Yii::t('app', 'Nationality'),
            'BLZ' => Yii::t('app', 'BLZ'),
            'Bank' => Yii::t('app', 'Bank'),
            'IBAN' => Yii::t('app', 'IBAN'),
            'KontoNr' => Yii::t('app', 'Account Number'),
            'Status' => Yii::t('app', 'State'),
            'AktivPassiv' => Yii::t('app', 'Passive'),
            'Kontoinhaber' => Yii::t('app', 'Account Holder'),
            'Schulort' => Yii::t('app', 'School Location'),
            'Disziplin' => Yii::t('app', 'Discipline'),
            'Funktion' => Yii::t('app', 'Function'),
            'Sifu' => Yii::t('app', 'Sifu'),
            'ErzBerechtigter' => Yii::t('app', 'Legal Guardian'),
            'Woher' => Yii::t('app', 'From'),
            'Graduierung' => Yii::t('app', 'Level'),
            'VDauer' => Yii::t('app', 'Contract Duration'),
            'Monatsbeitrag' => Yii::t('app', 'Monthly Fee'),
            'BeitrittDatum' => Yii::t('app', 'Entry Date'),
            'KuendigungDatum' => Yii::t('app', 'Termination'),
            'AustrittDatum' => Yii::t('app', 'Exit Datum'),
            'Geburtsort' => Yii::t('app', 'Location of Birth'),
            'GruppenArt' => Yii::t('app', 'Group-Type'),
            'Zahlungsart' => Yii::t('app', 'Payment Method'),
            'Zahlungsweise' => Yii::t('app', 'Payment Type'),
            'EinzugZum' => Yii::t('app', 'Bank Collection on'),
            'AufnahmegebuehrBezahlt' => Yii::t('app', 'Admission Fee Payed'),
            'EWTONr' => Yii::t('app', 'Ewtonr'),
            'EWTOAustritt' => Yii::t('app', 'Ewtoaustritt'),
            'BeitragOffenAb' => Yii::t('app', 'Beitrag Offen Ab'),
            'BeitragOffenEuro' => Yii::t('app', 'Beitrag Offen Euro'),
            'BeitragOffenBis' => Yii::t('app', 'Beitrag Offen Bis'),
            'Mahngebuehren' => Yii::t('app', 'Mahngebuehren'),
            'GesamtOffen' => Yii::t('app', 'Gesamt Offen'),
            'Mahnung1Am' => Yii::t('app', 'Mahnung1 Am'),
            'Mahnung2Am' => Yii::t('app', 'Mahnung2 Am'),
            'Mahnung3Am' => Yii::t('app', 'Mahnung3 Am'),
            'BarZahlungAm' => Yii::t('app', 'Bar Zahlung Am'),
            'InkassoAm' => Yii::t('app', 'Inkasso Am'),
            'Zahlungsfrist' => Yii::t('app', 'Zahlungsfrist'),
            'Bemerkungen' => Yii::t('app', 'Bemerkungen'),
            'Betreff' => Yii::t('app', 'Subject'),
            'Text' => Yii::t('app', 'Text'),
            'KontaktAm' => Yii::t('app', 'Contact On'),
            'KontaktArt' => Yii::t('app', 'Contact-Type'),
            'Bemerkung1' => Yii::t('app', 'Notice1'),
            'EinladungIAzum' => Yii::t('app', 'Invitation IA for'),
            'IABest' => Yii::t('app', 'IA confirmed'),
            'warZumIAda' => Yii::t('app', 'IA present'),
            'zumIAnichtDa' => Yii::t('app', 'IA not present'),
            'ProbetrainingAm' => Yii::t('app', 'Trial training on'),
            'PTwarDa' => Yii::t('app', 'Trial training present'),
            'zumPTnichtDa' => Yii::t('app', 'Trial training not present'),
            'VertragAbgeschlossen' => Yii::t('app', 'Contract made'),
            'VertragMit' => Yii::t('app', 'Contract with'),
            'Abschlussgespraech' => Yii::t('app', 'Final meeting'),
            'Bemerkung2' => Yii::t('app', 'Notice2'),
            'WTPruefungZum' => Yii::t('app', 'WT Test to'),
            'WTPruefungAm' => Yii::t('app', 'WT Test on'),
            'KPruefungZum' => Yii::t('app', 'Childs Test to'),
            'KPruefungAm' => Yii::t('app', 'Childs Test on'),
            'EPruefungZum' => Yii::t('app', 'Epruefung Zum'),
            'EPruefungAm' => Yii::t('app', 'Epruefung Am'),
            'GutscheinVon' => Yii::t('app', 'Voucher from'),
            'Name2Schule' => Yii::t('app', 'Name2 Schule'),
            'DM2Schule' => Yii::t('app', 'Dm2 Schule'),
            'NeuerBeitrag' => Yii::t('app', 'Neuer Beitrag'),
            'Vereinbarung' => Yii::t('app', 'Vereinbarung'),
            'RechnungsNr' => Yii::t('app', 'Rechnungs Nr'),
            'VErgaenzungAb' => Yii::t('app', 'Vergaenzung Ab'),
            'Land' => Yii::t('app', 'Country'),
            'AussetzenDauer' => Yii::t('app', 'Aussetzen Dauer'),
            'Betrag' => Yii::t('app', 'Betrag'),
            'BezahltAm' => Yii::t('app', 'Bezahlt Am'),
            'ZahlungsweiseBetrag' => Yii::t('app', 'Zahlungsweise Betrag'),
            'datumwt1sg' => Yii::t('app', 'Datumwt1sg'),
            'datumwt2sg' => Yii::t('app', 'Datumwt2sg'),
            'datumwt3sg' => Yii::t('app', 'Datumwt3sg'),
            'datumwt4sg' => Yii::t('app', 'Datumwt4sg'),
            'datumwt5sg' => Yii::t('app', 'Datumwt5sg'),
            'datumwt6sg' => Yii::t('app', 'Datumwt6sg'),
            'datumwt7sg' => Yii::t('app', 'Datumwt7sg'),
            'datumwt8sg' => Yii::t('app', 'Datumwt8sg'),
            'datumwt9sg' => Yii::t('app', 'Datumwt9sg'),
            'datumwt10sg' => Yii::t('app', 'Datumwt10sg'),
            'datumwt11sg' => Yii::t('app', 'Datumwt11sg'),
            'datumwt12sg' => Yii::t('app', 'Datumwt12sg'),
            'datumwt1tg' => Yii::t('app', 'Datumwt1tg'),
            'datumwt2tg' => Yii::t('app', 'Datumwt2tg'),
            'datumwt3tg' => Yii::t('app', 'Datumwt3tg'),
            'datumwt4tg' => Yii::t('app', 'Datumwt4tg'),
            'datumwt5pg' => Yii::t('app', 'Datumwt5pg'),
            'AufnahmegebuehrBezahltAm' => Yii::t('app', 'Admission Fee Payed On'),
            'datumWtPraktikum' => Yii::t('app', 'Date WT Internship'),
            'datumWtAusbilder1' => Yii::t('app', 'Date WT Instructor1'),
            'datumWtAusbilder2' => Yii::t('app', 'Date WT Instructor2'),
            'datumWtAusbilder3' => Yii::t('app', 'Date WT Instructor3'),
            'datumWtSchulleiter' => Yii::t('app', 'Date Headmaster'),
            'AufnGebuehrBetrag' => Yii::t('app', 'Admission Fee Amount'),
            'SFirm' => Yii::t('app', 'Sfirm'),
            'datumwt1sgk' => Yii::t('app', 'Datumwt1sgk'),
            'datumwt2sgk' => Yii::t('app', 'Datumwt2sgk'),
            'datumwt3sgk' => Yii::t('app', 'Datumwt3sgk'),
            'datumwt4sgk' => Yii::t('app', 'Datumwt4sgk'),
            'datumwt5sgk' => Yii::t('app', 'Datumwt5sgk'),
            'datumwt6sgk' => Yii::t('app', 'Datumwt6sgk'),
            'datumwt7sgk' => Yii::t('app', 'Datumwt7sgk'),
            'datumwt8sgk' => Yii::t('app', 'Datumwt8sgk'),
            'datumwt9sgk' => Yii::t('app', 'Datumwt9sgk'),
            'datumwt10sgk' => Yii::t('app', 'Datumwt10sgk'),
            'datumwt11sgk' => Yii::t('app', 'Datumwt11sgk'),
            'datumwt12sgk' => Yii::t('app', 'Datumwt12sgk'),
            'datume1sg' => Yii::t('app', 'Datume1sg'),
            'datume2sg' => Yii::t('app', 'Datume2sg'),
            'datume3sg' => Yii::t('app', 'Datume3sg'),
            'datume4sg' => Yii::t('app', 'Datume4sg'),
            'datume5sg' => Yii::t('app', 'Datume5sg'),
            'datume6sg' => Yii::t('app', 'Datume6sg'),
            'datume7sg' => Yii::t('app', 'Datume7sg'),
            'datume8sg' => Yii::t('app', 'Datume8sg'),
            'datume9sg' => Yii::t('app', 'Datume9sg'),
            'datume10sg' => Yii::t('app', 'Datume10sg'),
            'datume11sg' => Yii::t('app', 'Datume11sg'),
            'datume12sg' => Yii::t('app', 'Datume12sg'),
            'BListe' => Yii::t('app', 'Bliste'),
            'DVDgesendetAm' => Yii::t('app', 'DVD sent on'),
            'datume11tg' => Yii::t('app', 'Datume11tg'),
            'datume12tg' => Yii::t('app', 'Datume12tg'),
            'datume21tg' => Yii::t('app', 'Datume21tg'),
            'datume22tg' => Yii::t('app', 'Datume22tg'),
            'datume31tg' => Yii::t('app', 'Datume31tg'),
            'datume32tg' => Yii::t('app', 'Datume32tg'),
            'datume41tg' => Yii::t('app', 'Datume41tg'),
            'datume42tg' => Yii::t('app', 'Datume42tg'),
            'EsckrimaGraduierung' => Yii::t('app', 'Esckrima Graduierung'),
            'BeginnEsckrima' => Yii::t('app', 'Beginn Esckrima'),
            'EndeEsckrima' => Yii::t('app', 'Ende Esckrima'),
            'PruefungZum' => Yii::t('app', 'Test To'),
            'BIC' => Yii::t('app', 'BIC'),
            'kontaktNachricht1' => Yii::t('app', 'Kontakt-Nachricht'),
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
			
	   public function getMitgliederIntensiv() 
	   { 
	       return $this->hasOne(Intensiv::className(), ['mitgliederId' => 'MitgliederId']); 
		}
			
		public function showTriState($data) {
														if ($data == null) return ''; //'Unbekannt';
														if ($data == 0) return 'Nein';
														if ($data == 1) return 'Ja';
		}
			
    public static function getBuildPercentage() {
        $session = Yii::$app->session;
        return $session->get('checkPercent'); 
    }

    /* Getter for intensiv einstufung */
    public function getEinstufung() {
        $mitglied = $this->getMitgliederIntensiv();
        return $mitglied->einstufung;
    }

		public function beforeValidate() {
		    if (parent::beforeValidate()) {
//		    		$jetzt = new \yii\db\Expression('NOW();');
						date_default_timezone_set('Europe/Berlin');
						$this->LetzteAenderung = date('Y-m-d H:i:s');
						if (Yii::$app->user->identity->isAdmin) { $this->LetztAendSifu = $this->LetzteAenderung; }
		        return true;
		    }
		    return false;
		}
}
