<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MitgliederSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mitglieder-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'MitgliederId') ?>

    <?= $form->field($model, 'MitgliedsNr') ?>

    <?= $form->field($model, 'Vorname') ?>

    <?= $form->field($model, 'Name') ?>

    <?= $form->field($model, 'Geschlecht') ?>

    <?php // echo $form->field($model, 'Anrede') ?>

    <?php // echo $form->field($model, 'GeburtsDatum') ?>

    <?php // echo $form->field($model, 'PLZ') ?>

    <?php // echo $form->field($model, 'Wohnort') ?>

    <?php // echo $form->field($model, 'Strasse') ?>

    <?php // echo $form->field($model, 'Telefon1') ?>

    <?php // echo $form->field($model, 'Telefon2') ?>

    <?php // echo $form->field($model, 'HandyNr') ?>

    <?php // echo $form->field($model, 'Fax') ?>

    <?php // echo $form->field($model, 'LetzteAenderung') ?>

    <?php // echo $form->field($model, 'Email') ?>

    <?php // echo $form->field($model, 'Beruf') ?>

    <?php // echo $form->field($model, 'Nationalitaet') ?>

    <?php // echo $form->field($model, 'BLZ') ?>

    <?php // echo $form->field($model, 'Bank') ?>

    <?php // echo $form->field($model, 'KontoNr') ?>

    <?php // echo $form->field($model, 'Status') ?>

    <?php // echo $form->field($model, 'AktivPassiv') ?>

    <?php // echo $form->field($model, 'Kontoinhaber') ?>

    <?php // echo $form->field($model, 'Schulort') ?>

    <?php // echo $form->field($model, 'Disziplin') ?>

    <?php // echo $form->field($model, 'Funktion') ?>

    <?php // echo $form->field($model, 'Sifu') ?>

    <?php // echo $form->field($model, 'Woher') ?>

    <?php // echo $form->field($model, 'Graduierung') ?>

    <?php // echo $form->field($model, 'VDauer') ?>

    <?php // echo $form->field($model, 'Monatsbeitrag') ?>

    <?php // echo $form->field($model, 'BeitrittDatum') ?>

    <?php // echo $form->field($model, 'KuendigungDatum') ?>

    <?php // echo $form->field($model, 'AustrittDatum') ?>

    <?php // echo $form->field($model, 'Geburtsort') ?>

    <?php // echo $form->field($model, 'GruppenArt') ?>

    <?php // echo $form->field($model, 'Zahlungsart') ?>

    <?php // echo $form->field($model, 'Zahlungsweise') ?>

    <?php // echo $form->field($model, 'EinzugZum') ?>

    <?php // echo $form->field($model, 'BeitragAussetztenVon') ?>

    <?php // echo $form->field($model, 'BeitragAussetzenBis') ?>

    <?php // echo $form->field($model, 'BeitragAussetzenGrund') ?>

    <?php // echo $form->field($model, 'AufnahmegebuehrBezahlt') ?>

    <?php // echo $form->field($model, 'EWTONr') ?>

    <?php // echo $form->field($model, 'EWTOAustritt') ?>

    <?php // echo $form->field($model, 'BeitragOffenAb') ?>

    <?php // echo $form->field($model, 'BeitragOffenEuro') ?>

    <?php // echo $form->field($model, 'BeitragOffenBis') ?>

    <?php // echo $form->field($model, 'Mahngebuehren') ?>

    <?php // echo $form->field($model, 'GesamtOffen') ?>

    <?php // echo $form->field($model, 'Mahnung1Am') ?>

    <?php // echo $form->field($model, 'Mahnung2Am') ?>

    <?php // echo $form->field($model, 'Mahnung3Am') ?>

    <?php // echo $form->field($model, 'BarZahlungAm') ?>

    <?php // echo $form->field($model, 'InkassoAm') ?>

    <?php // echo $form->field($model, 'Zahlungsfrist') ?>

    <?php // echo $form->field($model, 'Bemerkungen') ?>

    <?php // echo $form->field($model, 'Betreff') ?>

    <?php // echo $form->field($model, 'Text') ?>

    <?php // echo $form->field($model, 'KontaktAm') ?>

    <?php // echo $form->field($model, 'KontaktArt') ?>

    <?php // echo $form->field($model, 'Bemerkung1') ?>

    <?php // echo $form->field($model, 'EinladungIAzum') ?>

    <?php // echo $form->field($model, 'warZumIAda') ?>

    <?php // echo $form->field($model, 'zumIAnichtDa') ?>

    <?php // echo $form->field($model, 'ProbetrainingAm') ?>

    <?php // echo $form->field($model, 'PTwarDa') ?>

    <?php // echo $form->field($model, 'zumPTnichtDa') ?>

    <?php // echo $form->field($model, 'VertragAbgeschlossen') ?>

    <?php // echo $form->field($model, 'VertragMit') ?>

    <?php // echo $form->field($model, 'Abschlussgespraech') ?>

    <?php // echo $form->field($model, 'Bemerkung2') ?>

    <?php // echo $form->field($model, 'WTPruefungZum') ?>

    <?php // echo $form->field($model, 'WTPruefungAm') ?>

    <?php // echo $form->field($model, 'KPruefungZum') ?>

    <?php // echo $form->field($model, 'KPruefungAm') ?>

    <?php // echo $form->field($model, 'EPruefungZum') ?>

    <?php // echo $form->field($model, 'EPruefungAm') ?>

    <?php // echo $form->field($model, 'GutscheinVon') ?>

    <?php // echo $form->field($model, 'Name2Schule') ?>

    <?php // echo $form->field($model, 'DM2Schule') ?>

    <?php // echo $form->field($model, 'NeuerBeitrag') ?>

    <?php // echo $form->field($model, 'Vereinbarung') ?>

    <?php // echo $form->field($model, 'RechnungsNr') ?>

    <?php // echo $form->field($model, 'VErgaenzungAb') ?>

    <?php // echo $form->field($model, 'Land') ?>

    <?php // echo $form->field($model, 'AussetzenDauer') ?>

    <?php // echo $form->field($model, 'Betrag') ?>

    <?php // echo $form->field($model, 'BezahltAm') ?>

    <?php // echo $form->field($model, 'ZahlungsweiseBetrag') ?>

    <?php // echo $form->field($model, 'datumwt1sg') ?>

    <?php // echo $form->field($model, 'datumwt2sg') ?>

    <?php // echo $form->field($model, 'datumwt3sg') ?>

    <?php // echo $form->field($model, 'datumwt4sg') ?>

    <?php // echo $form->field($model, 'datumwt5sg') ?>

    <?php // echo $form->field($model, 'datumwt6sg') ?>

    <?php // echo $form->field($model, 'datumwt7sg') ?>

    <?php // echo $form->field($model, 'datumwt8sg') ?>

    <?php // echo $form->field($model, 'datumwt9sg') ?>

    <?php // echo $form->field($model, 'datumwt10sg') ?>

    <?php // echo $form->field($model, 'datumwt11sg') ?>

    <?php // echo $form->field($model, 'datumwt12sg') ?>

    <?php // echo $form->field($model, 'datumwt1tg') ?>

    <?php // echo $form->field($model, 'datumwt2tg') ?>

    <?php // echo $form->field($model, 'datumwt3tg') ?>

    <?php // echo $form->field($model, 'datumwt4tg') ?>

    <?php // echo $form->field($model, 'datumwt5pg') ?>

    <?php // echo $form->field($model, 'AufnahmegebuehrBezahltAm') ?>

    <?php // echo $form->field($model, 'datumWtPraktikum') ?>

    <?php // echo $form->field($model, 'datumWtAusbilder1') ?>

    <?php // echo $form->field($model, 'datumWtAusbilder2') ?>

    <?php // echo $form->field($model, 'datumWtAusbilder3') ?>

    <?php // echo $form->field($model, 'datumWtSchulleiter') ?>

    <?php // echo $form->field($model, 'AufnGebuehrBetrag') ?>

    <?php // echo $form->field($model, 'SFirm') ?>

    <?php // echo $form->field($model, 'datumwt1sgk') ?>

    <?php // echo $form->field($model, 'datumwt2sgk') ?>

    <?php // echo $form->field($model, 'datumwt3sgk') ?>

    <?php // echo $form->field($model, 'datumwt4sgk') ?>

    <?php // echo $form->field($model, 'datumwt5sgk') ?>

    <?php // echo $form->field($model, 'datumwt6sgk') ?>

    <?php // echo $form->field($model, 'datumwt7sgk') ?>

    <?php // echo $form->field($model, 'datumwt8sgk') ?>

    <?php // echo $form->field($model, 'datumwt9sgk') ?>

    <?php // echo $form->field($model, 'datumwt10sgk') ?>

    <?php // echo $form->field($model, 'datumwt11sgk') ?>

    <?php // echo $form->field($model, 'datumwt12sgk') ?>

    <?php // echo $form->field($model, 'datume1sg') ?>

    <?php // echo $form->field($model, 'datume2sg') ?>

    <?php // echo $form->field($model, 'datume3sg') ?>

    <?php // echo $form->field($model, 'datume4sg') ?>

    <?php // echo $form->field($model, 'datume5sg') ?>

    <?php // echo $form->field($model, 'datume6sg') ?>

    <?php // echo $form->field($model, 'datume7sg') ?>

    <?php // echo $form->field($model, 'datume8sg') ?>

    <?php // echo $form->field($model, 'datume9sg') ?>

    <?php // echo $form->field($model, 'datume10sg') ?>

    <?php // echo $form->field($model, 'datume11sg') ?>

    <?php // echo $form->field($model, 'datume12sg') ?>

    <?php // echo $form->field($model, 'BListe') ?>

    <?php // echo $form->field($model, 'DVDgesendetAm') ?>

    <?php // echo $form->field($model, 'datume11tg') ?>

    <?php // echo $form->field($model, 'datume12tg') ?>

    <?php // echo $form->field($model, 'datume21tg') ?>

    <?php // echo $form->field($model, 'datume22tg') ?>

    <?php // echo $form->field($model, 'datume31tg') ?>

    <?php // echo $form->field($model, 'datume32tg') ?>

    <?php // echo $form->field($model, 'datume41tg') ?>

    <?php // echo $form->field($model, 'datume42tg') ?>

    <?php // echo $form->field($model, 'EsckrimaGraduierung') ?>

    <?php // echo $form->field($model, 'BeginnEsckrima') ?>

    <?php // echo $form->field($model, 'EndeEsckrima') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
