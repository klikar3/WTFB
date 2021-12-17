<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mitglieder".
 *
 * @property int $MitgliederId
 * @property int $MitgliedsNr
 * @property string|null $Vorname
 * @property string $Name
 * @property string|null $Geschlecht
 * @property string|null $Anrede
 * @property string|null $GeburtsDatum
 * @property string|null $PLZ
 * @property string|null $Wohnort
 * @property string|null $Strasse
 * @property string|null $Telefon1
 * @property string|null $Telefon2
 * @property string|null $HandyNr
 * @property string|null $Fax
 * @property string|null $LetzteAenderung
 * @property string|null $LetztAendSifu
 * @property string|null $Email
 * @property string|null $Beruf
 * @property string|null $Nationalitaet
 * @property string|null $BLZ
 * @property string|null $Bank
 * @property string|null $IBAN
 * @property string|null $KontoNr
 * @property string|null $Status
 * @property string|null $AktivPassiv
 * @property string|null $Kontoinhaber
 * @property string|null $Schulort
 * @property string|null $Disziplin
 * @property string|null $Funktion
 * @property string|null $Sifu
 * @property string|null $ErzBerechtigter
 * @property string|null $Woher
 * @property string|null $Graduierung
 * @property string|null $VDauer
 * @property string|null $BeitrittDatum
 * @property string|null $KuendigungDatum
 * @property string|null $AustrittDatum
 * @property string|null $Geburtsort
 * @property string|null $GruppenArt
 * @property string|null $EinzugZum
 * @property string|null $AufnahmegebuehrBezahlt
 * @property string|null $EWTONr
 * @property string|null $EWTOAustritt
 * @property string|null $BeitragOffenAb
 * @property string|null $BeitragOffenEuro
 * @property string|null $BeitragOffenBis
 * @property string|null $Mahngebuehren
 * @property string|null $GesamtOffen
 * @property string|null $Mahnung1Am
 * @property string|null $Mahnung2Am
 * @property string|null $Mahnung3Am
 * @property string|null $BarZahlungAm
 * @property string|null $InkassoAm
 * @property string|null $Zahlungsfrist
 * @property string|null $Bemerkungen
 * @property string|null $Betreff
 * @property string|null $Text
 * @property string|null $KontaktAm
 * @property string|null $KontaktArt
 * @property string|null $Bemerkung1
 * @property string|null $EinladungIAzum
 * @property int|null $IABest
 * @property int|null $WarZumIAda
 * @property string|null $zumIAnichtDa
 * @property string|null $ProbetrainingAm
 * @property int|null $PTwarDa
 * @property string|null $zumPTnichtDa
 * @property int|null $VertragAbgeschlossen
 * @property int|null $VertragMit
 * @property string|null $Abschlussgespraech
 * @property string|null $Bemerkung2
 * @property string|null $WTPruefungZum
 * @property string|null $WTPruefungAm
 * @property string|null $KPruefungZum
 * @property string|null $KPruefungAm
 * @property string|null $EPruefungZum
 * @property string|null $EPruefungAm
 * @property string|null $GutscheinVon
 * @property string|null $Name2Schule
 * @property string|null $DM2Schule
 * @property string|null $NeuerBeitrag
 * @property string|null $Vereinbarung
 * @property string|null $RechnungsNr
 * @property string|null $VErgaenzungAb
 * @property string|null $Land
 * @property string|null $AussetzenDauer
 * @property string|null $Betrag
 * @property string|null $BezahltAm
 * @property string|null $ZahlungsweiseBetrag
 * @property string|null $AufnahmegebuehrBezahltAm
 * @property string|null $datumWtPraktikum
 * @property string|null $datumWtAusbilder1
 * @property string|null $datumWtAusbilder2
 * @property string|null $datumWtAusbilder3
 * @property string|null $datumWtSchulleiter
 * @property string|null $AufnGebuehrBetrag
 * @property int|null $SFirm
 * @property int|null $BListe
 * @property string|null $DVDgesendetAm
 * @property string|null $EsckrimaGraduierung
 * @property string|null $BeginnEsckrima
 * @property string|null $EndeEsckrima
 * @property int|null $PruefungZum
 * @property string|null $GD
 * @property string|null $BIC
 * @property int|null $mig_int
 * @property string|null $mandatNr
 * @property string|null $mandatDatum
 * @property int $RecDeleted
 * @property string|null $letzteDvd
 * @property string|null $kontaktNachricht1
 * @property string|null $wiederVorlageAm
 *
 * @property Anwesenheitsliste[] $anwesenheitslistes
 * @property Grade[] $grads
 * @property Mitgliederdisziplinen[] $mitgliederdisziplinens
 * @property Mitgliedergrade[] $mitgliedergrades
 * @property Mitgliederschulen[] $mitgliederschulens
 */
class Mitglieder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mitglieder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MitgliederId', 'Name'], 'required'],
            [['MitgliederId', 'MitgliedsNr', 'IABest', 'WarZumIAda', 'PTwarDa', 'VertragAbgeschlossen', 'VertragMit', 'SFirm', 'BListe', 'PruefungZum', 'mig_int', 'RecDeleted'], 'integer'],
            [['GeburtsDatum', 'LetzteAenderung', 'LetztAendSifu', 'BeitrittDatum', 'KuendigungDatum', 'AustrittDatum', 'Mahnung1Am', 'Mahnung2Am', 'Mahnung3Am', 'BarZahlungAm', 'InkassoAm', 'KontaktAm', 'EinladungIAzum', 'ProbetrainingAm', 'WTPruefungAm', 'KPruefungAm', 'EPruefungAm', 'AufnahmegebuehrBezahltAm', 'datumWtPraktikum', 'datumWtAusbilder1', 'datumWtAusbilder2', 'datumWtAusbilder3', 'datumWtSchulleiter', 'DVDgesendetAm', 'BeginnEsckrima', 'EndeEsckrima', 'mandatDatum', 'wiederVorlageAm'], 'safe'],
            [['kontaktNachricht1'], 'string'],
            [['Vorname', 'Geschlecht', 'Disziplin', 'GD'], 'string', 'max' => 20],
            [['Name', 'Anrede', 'Wohnort', 'Strasse', 'Schulort', 'Sifu', 'KontaktArt', 'letzteDvd'], 'string', 'max' => 50],
            [['PLZ', 'Fax', 'VDauer', 'BeitragOffenBis'], 'string', 'max' => 13],
            [['Telefon1', 'HandyNr', 'GruppenArt', 'BeitragOffenAb'], 'string', 'max' => 18],
            [['Telefon2', 'AufnahmegebuehrBezahlt', 'WTPruefungZum'], 'string', 'max' => 14],
            [['Email'], 'string', 'max' => 42],
            [['Beruf'], 'string', 'max' => 35],
            [['Nationalitaet'], 'string', 'max' => 22],
            [['BLZ', 'Mahngebuehren', 'Vereinbarung', 'VErgaenzungAb', 'AufnGebuehrBetrag', 'EsckrimaGraduierung'], 'string', 'max' => 9],
            [['Bank'], 'string', 'max' => 100],
            [['IBAN'], 'string', 'max' => 25],
            [['KontoNr', 'AktivPassiv', 'EWTONr', 'EWTOAustritt', 'BeitragOffenEuro', 'GesamtOffen', 'Abschlussgespraech', 'Bemerkung2', 'GutscheinVon', 'NeuerBeitrag', 'Land', 'AussetzenDauer', 'Betrag', 'ZahlungsweiseBetrag'], 'string', 'max' => 10],
            [['Status'], 'string', 'max' => 17],
            [['Kontoinhaber'], 'string', 'max' => 31],
            [['Funktion', 'Graduierung'], 'string', 'max' => 16],
            [['ErzBerechtigter'], 'string', 'max' => 155],
            [['Woher'], 'string', 'max' => 27],
            [['Geburtsort'], 'string', 'max' => 26],
            [['EinzugZum'], 'string', 'max' => 15],
            [['Zahlungsfrist', 'Name2Schule', 'BezahltAm'], 'string', 'max' => 19],
            [['Bemerkungen'], 'string', 'max' => 294],
            [['Betreff', 'mandatNr'], 'string', 'max' => 30],
            [['Text'], 'string', 'max' => 426],
            [['Bemerkung1'], 'string', 'max' => 512],
            [['zumIAnichtDa', 'zumPTnichtDa'], 'string', 'max' => 6],
            [['KPruefungZum', 'EPruefungZum'], 'string', 'max' => 12],
            [['DM2Schule'], 'string', 'max' => 5],
            [['RechnungsNr'], 'string', 'max' => 1],
            [['BIC'], 'string', 'max' => 11],
            [['MitgliederId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MitgliederId' => Yii::t('app', 'Mitglieder ID'),
            'MitgliedsNr' => Yii::t('app', 'Mitglieds Nr'),
            'Vorname' => Yii::t('app', 'Vorname'),
            'Name' => Yii::t('app', 'Name'),
            'Geschlecht' => Yii::t('app', 'Geschlecht'),
            'Anrede' => Yii::t('app', 'Anrede'),
            'GeburtsDatum' => Yii::t('app', 'Geburts Datum'),
            'PLZ' => Yii::t('app', 'Plz'),
            'Wohnort' => Yii::t('app', 'Wohnort'),
            'Strasse' => Yii::t('app', 'Strasse'),
            'Telefon1' => Yii::t('app', 'Telefon1'),
            'Telefon2' => Yii::t('app', 'Telefon2'),
            'HandyNr' => Yii::t('app', 'Handy Nr'),
            'Fax' => Yii::t('app', 'Fax'),
            'LetzteAenderung' => Yii::t('app', 'Letzte Aenderung'),
            'LetztAendSifu' => Yii::t('app', 'Letzt Aend Sifu'),
            'Email' => Yii::t('app', 'Email'),
            'Beruf' => Yii::t('app', 'Beruf'),
            'Nationalitaet' => Yii::t('app', 'Nationalitaet'),
            'BLZ' => Yii::t('app', 'Blz'),
            'Bank' => Yii::t('app', 'Bank'),
            'IBAN' => Yii::t('app', 'Iban'),
            'KontoNr' => Yii::t('app', 'Konto Nr'),
            'Status' => Yii::t('app', 'Status'),
            'AktivPassiv' => Yii::t('app', 'Aktiv Passiv'),
            'Kontoinhaber' => Yii::t('app', 'Kontoinhaber'),
            'Schulort' => Yii::t('app', 'Schulort'),
            'Disziplin' => Yii::t('app', 'Disziplin'),
            'Funktion' => Yii::t('app', 'Funktion'),
            'Sifu' => Yii::t('app', 'Sifu'),
            'ErzBerechtigter' => Yii::t('app', 'Erz Berechtigter'),
            'Woher' => Yii::t('app', 'Woher'),
            'Graduierung' => Yii::t('app', 'Graduierung'),
            'VDauer' => Yii::t('app', 'V Dauer'),
            'BeitrittDatum' => Yii::t('app', 'Beitritt Datum'),
            'KuendigungDatum' => Yii::t('app', 'Kuendigung Datum'),
            'AustrittDatum' => Yii::t('app', 'Austritt Datum'),
            'Geburtsort' => Yii::t('app', 'Geburtsort'),
            'GruppenArt' => Yii::t('app', 'Gruppen Art'),
            'EinzugZum' => Yii::t('app', 'Einzug Zum'),
            'AufnahmegebuehrBezahlt' => Yii::t('app', 'Aufnahmegebuehr Bezahlt'),
            'EWTONr' => Yii::t('app', 'Ewto Nr'),
            'EWTOAustritt' => Yii::t('app', 'Ewto Austritt'),
            'BeitragOffenAb' => Yii::t('app', 'Beitrag Offen Ab'),
            'BeitragOffenEuro' => Yii::t('app', 'Beitrag Offen Euro'),
            'BeitragOffenBis' => Yii::t('app', 'Beitrag Offen Bis'),
            'Mahngebuehren' => Yii::t('app', 'Mahngebuehren'),
            'GesamtOffen' => Yii::t('app', 'Gesamt Offen'),
            'Mahnung1Am' => Yii::t('app', 'Mahnung1am'),
            'Mahnung2Am' => Yii::t('app', 'Mahnung2am'),
            'Mahnung3Am' => Yii::t('app', 'Mahnung3am'),
            'BarZahlungAm' => Yii::t('app', 'Bar Zahlung Am'),
            'InkassoAm' => Yii::t('app', 'Inkasso Am'),
            'Zahlungsfrist' => Yii::t('app', 'Zahlungsfrist'),
            'Bemerkungen' => Yii::t('app', 'Bemerkungen'),
            'Betreff' => Yii::t('app', 'Betreff'),
            'Text' => Yii::t('app', 'Text'),
            'KontaktAm' => Yii::t('app', 'Kontakt Am'),
            'KontaktArt' => Yii::t('app', 'Kontakt Art'),
            'Bemerkung1' => Yii::t('app', 'Bemerkung1'),
            'EinladungIAzum' => Yii::t('app', 'Einladung I Azum'),
            'IABest' => Yii::t('app', 'Ia Best'),
            'WarZumIAda' => Yii::t('app', 'War Zum I Ada'),
            'zumIAnichtDa' => Yii::t('app', 'Zum I Anicht Da'),
            'ProbetrainingAm' => Yii::t('app', 'Probetraining Am'),
            'PTwarDa' => Yii::t('app', 'P Twar Da'),
            'zumPTnichtDa' => Yii::t('app', 'Zum P Tnicht Da'),
            'VertragAbgeschlossen' => Yii::t('app', 'Vertrag Abgeschlossen'),
            'VertragMit' => Yii::t('app', 'Vertrag Mit'),
            'Abschlussgespraech' => Yii::t('app', 'Abschlussgespraech'),
            'Bemerkung2' => Yii::t('app', 'Bemerkung2'),
            'WTPruefungZum' => Yii::t('app', 'Wt Pruefung Zum'),
            'WTPruefungAm' => Yii::t('app', 'Wt Pruefung Am'),
            'KPruefungZum' => Yii::t('app', 'K Pruefung Zum'),
            'KPruefungAm' => Yii::t('app', 'K Pruefung Am'),
            'EPruefungZum' => Yii::t('app', 'E Pruefung Zum'),
            'EPruefungAm' => Yii::t('app', 'E Pruefung Am'),
            'GutscheinVon' => Yii::t('app', 'Gutschein Von'),
            'Name2Schule' => Yii::t('app', 'Name2schule'),
            'DM2Schule' => Yii::t('app', 'Dm2schule'),
            'NeuerBeitrag' => Yii::t('app', 'Neuer Beitrag'),
            'Vereinbarung' => Yii::t('app', 'Vereinbarung'),
            'RechnungsNr' => Yii::t('app', 'Rechnungs Nr'),
            'VErgaenzungAb' => Yii::t('app', 'V Ergaenzung Ab'),
            'Land' => Yii::t('app', 'Land'),
            'AussetzenDauer' => Yii::t('app', 'Aussetzen Dauer'),
            'Betrag' => Yii::t('app', 'Betrag'),
            'BezahltAm' => Yii::t('app', 'Bezahlt Am'),
            'ZahlungsweiseBetrag' => Yii::t('app', 'Zahlungsweise Betrag'),
            'AufnahmegebuehrBezahltAm' => Yii::t('app', 'Aufnahmegebuehr Bezahlt Am'),
            'datumWtPraktikum' => Yii::t('app', 'Datum Wt Praktikum'),
            'datumWtAusbilder1' => Yii::t('app', 'Datum Wt Ausbilder1'),
            'datumWtAusbilder2' => Yii::t('app', 'Datum Wt Ausbilder2'),
            'datumWtAusbilder3' => Yii::t('app', 'Datum Wt Ausbilder3'),
            'datumWtSchulleiter' => Yii::t('app', 'Datum Wt Schulleiter'),
            'AufnGebuehrBetrag' => Yii::t('app', 'Aufn Gebuehr Betrag'),
            'SFirm' => Yii::t('app', 'S Firm'),
            'BListe' => Yii::t('app', 'B Liste'),
            'DVDgesendetAm' => Yii::t('app', 'Dv Dgesendet Am'),
            'EsckrimaGraduierung' => Yii::t('app', 'Esckrima Graduierung'),
            'BeginnEsckrima' => Yii::t('app', 'Beginn Esckrima'),
            'EndeEsckrima' => Yii::t('app', 'Ende Esckrima'),
            'PruefungZum' => Yii::t('app', 'Pruefung Zum'),
            'GD' => Yii::t('app', 'Gd'),
            'BIC' => Yii::t('app', 'Bic'),
            'mig_int' => Yii::t('app', 'Mig Int'),
            'mandatNr' => Yii::t('app', 'Mandat Nr'),
            'mandatDatum' => Yii::t('app', 'Mandat Datum'),
            'RecDeleted' => Yii::t('app', 'Rec Deleted'),
            'letzteDvd' => Yii::t('app', 'Letzte Dvd'),
            'kontaktNachricht1' => Yii::t('app', 'Kontakt Nachricht1'),
            'wiederVorlageAm' => Yii::t('app', 'Wieder Vorlage Am'),
        ];
    }

    /**
     * Gets query for [[Anwesenheitslistes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAnwesenheitslistes()
    {
        return $this->hasMany(Anwesenheitsliste::className(), ['mitglied' => 'MitgliederId']);
    }

    /**
     * Gets query for [[Grads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrads()
    {
        return $this->hasMany(Grade::className(), ['gradId' => 'GradId'])->viaTable('mitgliedergrade', ['MitgliedId' => 'MitgliederId']);
    }

    /**
     * Gets query for [[Mitgliederdisziplinens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMitgliederdisziplinens()
    {
        return $this->hasMany(Mitgliederdisziplinen::className(), ['MitgliedId' => 'MitgliederId']);
    }

    /**
     * Gets query for [[Mitgliedergrades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMitgliedergrades()
    {
        return $this->hasMany(Mitgliedergrade::className(), ['MitgliedId' => 'MitgliederId']);
    }

    /**
     * Gets query for [[Mitgliederschulens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMitgliederschulens()
    {
        return $this->hasMany(Mitgliederschulen::className(), ['MitgliederId' => 'MitgliederId']);
    }
}
