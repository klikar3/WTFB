<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Mitglieder;

/**
 * MitgliederSearch represents the model behind the search form about `app\models\Mitglieder`.
 */
class MitgliederSearch extends Mitglieder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MitgliederId', 'VertragMit', 'SFirm', 'BListe'], 'integer'],
            [['MitgliedsNr', 'Vorname', 'Name', 'Geschlecht', 'Anrede', 'GeburtsDatum', 'PLZ', 'Wohnort', 'Strasse', 'Telefon1', 'Telefon2', 'HandyNr', 'Fax', 'LetzteAenderung', 'Email', 'Beruf', 'Nationalitaet', 'BLZ', 'Bank', 'KontoNr', 'Status', 'AktivPassiv', 'Kontoinhaber', 'Schulort', 'Disziplin', 'Funktion', 'Sifu', 'Woher', 'Graduierung', 'VDauer', 'Monatsbeitrag', 'BeitrittDatum', 'KuendigungDatum', 'AustrittDatum', 'Geburtsort', 'GruppenArt', 'Zahlungsart', 'Zahlungsweise', 'EinzugZum', 'BeitragAussetztenVon', 'BeitragAussetzenBis', 'BeitragAussetzenGrund', 'AufnahmegebuehrBezahlt', 'EWTONr', 'EWTOAustritt', 'BeitragOffenAb', 'BeitragOffenEuro', 'BeitragOffenBis', 'Mahngebuehren', 'GesamtOffen', 'Mahnung1Am', 'Mahnung2Am', 'Mahnung3Am', 'BarZahlungAm', 'InkassoAm', 'Zahlungsfrist', 'Bemerkungen', 'Betreff', 'Text', 'KontaktAm', 'KontaktArt', 'Bemerkung1', 'EinladungIAzum', 'warZumIAda', 'zumIAnichtDa', 'ProbetrainingAm', 'PTwarDa', 'zumPTnichtDa', 'VertragAbgeschlossen', 'Abschlussgespraech', 'Bemerkung2', 'WTPruefungZum', 'WTPruefungAm', 'KPruefungZum', 'KPruefungAm', 'EPruefungZum', 'EPruefungAm', 'GutscheinVon', 'Name2Schule', 'DM2Schule', 'NeuerBeitrag', 'Vereinbarung', 'RechnungsNr', 'VErgaenzungAb', 'Land', 'AussetzenDauer', 'Betrag', 'BezahltAm', 'ZahlungsweiseBetrag', 'datumwt1sg', 'datumwt2sg', 'datumwt3sg', 'datumwt4sg', 'datumwt5sg', 'datumwt6sg', 'datumwt7sg', 'datumwt8sg', 'datumwt9sg', 'datumwt10sg', 'datumwt11sg', 'datumwt12sg', 'datumwt1tg', 'datumwt2tg', 'datumwt3tg', 'datumwt4tg', 'datumwt5pg', 'AufnahmegebuehrBezahltAm', 'datumWtPraktikum', 'datumWtAusbilder1', 'datumWtAusbilder2', 'datumWtAusbilder3', 'datumWtSchulleiter', 'AufnGebuehrBetrag', 'DVDgesendetAm', 'datume11tg', 'datume12tg', 'datume21tg', 'datume22tg', 'datume31tg', 'datume32tg', 'datume41tg', 'datume42tg', 'EsckrimaGraduierung', 'BeginnEsckrima', 'EndeEsckrima', 'PruefungZum'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Mitglieder::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'MitgliederId' => $this->MitgliederId,
            'VertragMit' => $this->VertragMit,
            'SFirm' => $this->SFirm,
            'BListe' => $this->BListe,
        ]);

        $query->andFilterWhere(['like', 'MitgliedsNr', $this->MitgliedsNr])
            ->andFilterWhere(['like', 'Vorname', $this->Vorname])
            ->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'Geschlecht', $this->Geschlecht])
            ->andFilterWhere(['like', 'Anrede', $this->Anrede])
            ->andFilterWhere(['like', 'GeburtsDatum', $this->GeburtsDatum])
            ->andFilterWhere(['like', 'PLZ', $this->PLZ])
            ->andFilterWhere(['like', 'Wohnort', $this->Wohnort])
            ->andFilterWhere(['like', 'Strasse', $this->Strasse])
            ->andFilterWhere(['like', 'Telefon1', $this->Telefon1])
            ->andFilterWhere(['like', 'Telefon2', $this->Telefon2])
            ->andFilterWhere(['like', 'HandyNr', $this->HandyNr])
            ->andFilterWhere(['like', 'Fax', $this->Fax])
            ->andFilterWhere(['like', 'LetzteAenderung', $this->LetzteAenderung])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'Beruf', $this->Beruf])
            ->andFilterWhere(['like', 'Nationalitaet', $this->Nationalitaet])
            ->andFilterWhere(['like', 'BLZ', $this->BLZ])
            ->andFilterWhere(['like', 'Bank', $this->Bank])
            ->andFilterWhere(['like', 'KontoNr', $this->KontoNr])
            ->andFilterWhere(['like', 'Status', $this->Status])
            ->andFilterWhere(['like', 'AktivPassiv', $this->AktivPassiv])
            ->andFilterWhere(['like', 'Kontoinhaber', $this->Kontoinhaber])
            ->andFilterWhere(['like', 'Schulort', $this->Schulort])
            ->andFilterWhere(['like', 'Disziplin', $this->Disziplin])
            ->andFilterWhere(['like', 'Funktion', $this->Funktion])
            ->andFilterWhere(['like', 'Sifu', $this->Sifu])
            ->andFilterWhere(['like', 'PruefungZum', $this->PruefungZum])
            ->andFilterWhere(['like', 'Woher', $this->Woher])
            ->andFilterWhere(['like', 'Graduierung', $this->Graduierung])
            ->andFilterWhere(['like', 'VDauer', $this->VDauer])
            ->andFilterWhere(['like', 'Monatsbeitrag', $this->Monatsbeitrag])
            ->andFilterWhere(['like', 'BeitrittDatum', $this->BeitrittDatum])
            ->andFilterWhere(['like', 'KuendigungDatum', $this->KuendigungDatum])
            ->andFilterWhere(['like', 'AustrittDatum', $this->AustrittDatum])
            ->andFilterWhere(['like', 'Geburtsort', $this->Geburtsort])
            ->andFilterWhere(['like', 'GruppenArt', $this->GruppenArt])
            ->andFilterWhere(['like', 'Zahlungsart', $this->Zahlungsart])
            ->andFilterWhere(['like', 'Zahlungsweise', $this->Zahlungsweise])
            ->andFilterWhere(['like', 'EinzugZum', $this->EinzugZum])
            ->andFilterWhere(['like', 'BeitragAussetztenVon', $this->BeitragAussetztenVon])
            ->andFilterWhere(['like', 'BeitragAussetzenBis', $this->BeitragAussetzenBis])
            ->andFilterWhere(['like', 'BeitragAussetzenGrund', $this->BeitragAussetzenGrund])
            ->andFilterWhere(['like', 'AufnahmegebuehrBezahlt', $this->AufnahmegebuehrBezahlt])
            ->andFilterWhere(['like', 'EWTONr', $this->EWTONr])
            ->andFilterWhere(['like', 'EWTOAustritt', $this->EWTOAustritt])
            ->andFilterWhere(['like', 'BeitragOffenAb', $this->BeitragOffenAb])
            ->andFilterWhere(['like', 'BeitragOffenEuro', $this->BeitragOffenEuro])
            ->andFilterWhere(['like', 'BeitragOffenBis', $this->BeitragOffenBis])
            ->andFilterWhere(['like', 'Mahngebuehren', $this->Mahngebuehren])
            ->andFilterWhere(['like', 'GesamtOffen', $this->GesamtOffen])
            ->andFilterWhere(['like', 'Mahnung1Am', $this->Mahnung1Am])
            ->andFilterWhere(['like', 'Mahnung2Am', $this->Mahnung2Am])
            ->andFilterWhere(['like', 'Mahnung3Am', $this->Mahnung3Am])
            ->andFilterWhere(['like', 'BarZahlungAm', $this->BarZahlungAm])
            ->andFilterWhere(['like', 'InkassoAm', $this->InkassoAm])
            ->andFilterWhere(['like', 'Zahlungsfrist', $this->Zahlungsfrist])
            ->andFilterWhere(['like', 'Bemerkungen', $this->Bemerkungen])
            ->andFilterWhere(['like', 'Betreff', $this->Betreff])
            ->andFilterWhere(['like', 'Text', $this->Text])
            ->andFilterWhere(['like', 'KontaktAm', $this->KontaktAm])
            ->andFilterWhere(['like', 'KontaktArt', $this->KontaktArt])
            ->andFilterWhere(['like', 'Bemerkung1', $this->Bemerkung1])
            ->andFilterWhere(['like', 'EinladungIAzum', $this->EinladungIAzum])
            ->andFilterWhere(['like', 'warZumIAda', $this->warZumIAda])
            ->andFilterWhere(['like', 'zumIAnichtDa', $this->zumIAnichtDa])
            ->andFilterWhere(['like', 'ProbetrainingAm', $this->ProbetrainingAm])
            ->andFilterWhere(['like', 'PTwarDa', $this->PTwarDa])
            ->andFilterWhere(['like', 'zumPTnichtDa', $this->zumPTnichtDa])
            ->andFilterWhere(['like', 'VertragAbgeschlossen', $this->VertragAbgeschlossen])
            ->andFilterWhere(['like', 'Abschlussgespraech', $this->Abschlussgespraech])
            ->andFilterWhere(['like', 'Bemerkung2', $this->Bemerkung2])
            ->andFilterWhere(['like', 'WTPruefungZum', $this->WTPruefungZum])
            ->andFilterWhere(['like', 'WTPruefungAm', $this->WTPruefungAm])
            ->andFilterWhere(['like', 'KPruefungZum', $this->KPruefungZum])
            ->andFilterWhere(['like', 'KPruefungAm', $this->KPruefungAm])
            ->andFilterWhere(['like', 'EPruefungZum', $this->EPruefungZum])
            ->andFilterWhere(['like', 'EPruefungAm', $this->EPruefungAm])
            ->andFilterWhere(['like', 'GutscheinVon', $this->GutscheinVon])
            ->andFilterWhere(['like', 'Name2Schule', $this->Name2Schule])
            ->andFilterWhere(['like', 'DM2Schule', $this->DM2Schule])
            ->andFilterWhere(['like', 'NeuerBeitrag', $this->NeuerBeitrag])
            ->andFilterWhere(['like', 'Vereinbarung', $this->Vereinbarung])
            ->andFilterWhere(['like', 'RechnungsNr', $this->RechnungsNr])
            ->andFilterWhere(['like', 'VErgaenzungAb', $this->VErgaenzungAb])
            ->andFilterWhere(['like', 'Land', $this->Land])
            ->andFilterWhere(['like', 'AussetzenDauer', $this->AussetzenDauer])
            ->andFilterWhere(['like', 'Betrag', $this->Betrag])
            ->andFilterWhere(['like', 'BezahltAm', $this->BezahltAm])
            ->andFilterWhere(['like', 'ZahlungsweiseBetrag', $this->ZahlungsweiseBetrag])
            ->andFilterWhere(['like', 'datumwt1sg', $this->datumwt1sg])
            ->andFilterWhere(['like', 'datumwt2sg', $this->datumwt2sg])
            ->andFilterWhere(['like', 'datumwt3sg', $this->datumwt3sg])
            ->andFilterWhere(['like', 'datumwt4sg', $this->datumwt4sg])
            ->andFilterWhere(['like', 'datumwt5sg', $this->datumwt5sg])
            ->andFilterWhere(['like', 'datumwt6sg', $this->datumwt6sg])
            ->andFilterWhere(['like', 'datumwt7sg', $this->datumwt7sg])
            ->andFilterWhere(['like', 'datumwt8sg', $this->datumwt8sg])
            ->andFilterWhere(['like', 'datumwt9sg', $this->datumwt9sg])
            ->andFilterWhere(['like', 'datumwt10sg', $this->datumwt10sg])
            ->andFilterWhere(['like', 'datumwt11sg', $this->datumwt11sg])
            ->andFilterWhere(['like', 'datumwt12sg', $this->datumwt12sg])
            ->andFilterWhere(['like', 'datumwt1tg', $this->datumwt1tg])
            ->andFilterWhere(['like', 'datumwt2tg', $this->datumwt2tg])
            ->andFilterWhere(['like', 'datumwt3tg', $this->datumwt3tg])
            ->andFilterWhere(['like', 'datumwt4tg', $this->datumwt4tg])
            ->andFilterWhere(['like', 'datumwt5pg', $this->datumwt5pg])
            ->andFilterWhere(['like', 'AufnahmegebuehrBezahltAm', $this->AufnahmegebuehrBezahltAm])
            ->andFilterWhere(['like', 'datumWtPraktikum', $this->datumWtPraktikum])
            ->andFilterWhere(['like', 'datumWtAusbilder1', $this->datumWtAusbilder1])
            ->andFilterWhere(['like', 'datumWtAusbilder2', $this->datumWtAusbilder2])
            ->andFilterWhere(['like', 'datumWtAusbilder3', $this->datumWtAusbilder3])
            ->andFilterWhere(['like', 'datumWtSchulleiter', $this->datumWtSchulleiter])
            ->andFilterWhere(['like', 'AufnGebuehrBetrag', $this->AufnGebuehrBetrag])
            ->andFilterWhere(['like', 'datumwt1sgk', $this->datumwt1sgk])
            ->andFilterWhere(['like', 'datumwt2sgk', $this->datumwt2sgk])
            ->andFilterWhere(['like', 'datumwt3sgk', $this->datumwt3sgk])
            ->andFilterWhere(['like', 'datumwt4sgk', $this->datumwt4sgk])
            ->andFilterWhere(['like', 'datumwt5sgk', $this->datumwt5sgk])
            ->andFilterWhere(['like', 'datumwt6sgk', $this->datumwt6sgk])
            ->andFilterWhere(['like', 'datumwt7sgk', $this->datumwt7sgk])
            ->andFilterWhere(['like', 'datumwt8sgk', $this->datumwt8sgk])
            ->andFilterWhere(['like', 'datumwt9sgk', $this->datumwt9sgk])
            ->andFilterWhere(['like', 'datumwt10sgk', $this->datumwt10sgk])
            ->andFilterWhere(['like', 'datumwt11sgk', $this->datumwt11sgk])
            ->andFilterWhere(['like', 'datumwt12sgk', $this->datumwt12sgk])
            ->andFilterWhere(['like', 'datume1sg', $this->datume1sg])
            ->andFilterWhere(['like', 'datume2sg', $this->datume2sg])
            ->andFilterWhere(['like', 'datume3sg', $this->datume3sg])
            ->andFilterWhere(['like', 'datume4sg', $this->datume4sg])
            ->andFilterWhere(['like', 'datume5sg', $this->datume5sg])
            ->andFilterWhere(['like', 'datume6sg', $this->datume6sg])
            ->andFilterWhere(['like', 'datume7sg', $this->datume7sg])
            ->andFilterWhere(['like', 'datume8sg', $this->datume8sg])
            ->andFilterWhere(['like', 'datume9sg', $this->datume9sg])
            ->andFilterWhere(['like', 'datume10sg', $this->datume10sg])
            ->andFilterWhere(['like', 'datume11sg', $this->datume11sg])
            ->andFilterWhere(['like', 'datume12sg', $this->datume12sg])
            ->andFilterWhere(['like', 'DVDgesendetAm', $this->DVDgesendetAm])
            ->andFilterWhere(['like', 'datume11tg', $this->datume11tg])
            ->andFilterWhere(['like', 'datume12tg', $this->datume12tg])
            ->andFilterWhere(['like', 'datume21tg', $this->datume21tg])
            ->andFilterWhere(['like', 'datume22tg', $this->datume22tg])
            ->andFilterWhere(['like', 'datume31tg', $this->datume31tg])
            ->andFilterWhere(['like', 'datume32tg', $this->datume32tg])
            ->andFilterWhere(['like', 'datume41tg', $this->datume41tg])
            ->andFilterWhere(['like', 'datume42tg', $this->datume42tg])
            ->andFilterWhere(['like', 'EsckrimaGraduierung', $this->EsckrimaGraduierung])
            ->andFilterWhere(['like', 'BeginnEsckrima', $this->BeginnEsckrima])
            ->andFilterWhere(['like', 'EndeEsckrima', $this->EndeEsckrima]);

        return $dataProvider;
    }
}
