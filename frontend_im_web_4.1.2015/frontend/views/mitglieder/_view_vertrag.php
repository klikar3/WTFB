<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;

use frontend\models\Mitgliedergrade;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Pruefer;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>

<div class="row">
	<div class="col-sm-6">
     <div id="content" >
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
             'BLZ',
             'Bank',
             'KontoNr',
             'Status',
             'AktivPassiv',
             'Kontoinhaber',
        ],
    ]); ?>

     </div><!-- content -->
  </div> <!-- col -->
	<div class="col-sm-6">
     <div id="content" >
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
             'VDauer',
             'Monatsbeitrag',
             'BeitrittDatum',
             'KuendigungDatum',
             'AustrittDatum',
             'Geburtsort',
             'GruppenArt',
             'Zahlungsart',
             'Zahlungsweise',
             'EinzugZum',
             'BeitragAussetztenVon',
             'BeitragAussetzenBis',
             'BeitragAussetzenGrund',
             'AufnahmegebuehrBezahlt',
            // 'EWTONr',
            // 'EWTOAustritt',
            // 'BeitragOffenAb',
            // 'BeitragOffenEuro',
            // 'BeitragOffenBis',
            // 'Mahngebuehren',
            // 'GesamtOffen',
            // 'Mahnung1Am',
            // 'Mahnung2Am',
            // 'Mahnung3Am',
            // 'BarZahlungAm',
            // 'InkassoAm',
            // 'Zahlungsfrist',
            // 'Bemerkungen',
            // 'Betreff',
            // 'Text',
            // 'KontaktAm',
            // 'KontaktArt',
            // 'Bemerkung1',
            // 'EinladungIAzum',
            // 'warZumIAda',
            // 'zumIAnichtDa',
            // 'ProbetrainingAm',
            // 'PTwarDa',
            // 'zumPTnichtDa',
            // 'VertragAbgeschlossen',
            // 'VertragMit',
            // 'Abschlussgespraech',
            // 'Bemerkung2',
            // 'WTPruefungZum',
            // 'WTPruefungAm',
            // 'KPruefungZum',
            // 'KPruefungAm',
            // 'EPruefungZum',
            // 'EPruefungAm',
            // 'GutscheinVon',
            // 'Name2Schule',
            // 'DM2Schule',
            // 'NeuerBeitrag',
            // 'Vereinbarung',
            // 'RechnungsNr',
            // 'VErgaenzungAb',
            // 'Land',
            // 'AussetzenDauer',
            // 'Betrag',
            // 'BezahltAm',
            // 'ZahlungsweiseBetrag',
          // 'AufnahmegebuehrBezahltAm',
            // 'AufnGebuehrBetrag',
            // 'SFirm',
          // 'BListe',
            // 'DVDgesendetAm',
            // 'EsckrimaGraduierung',
            // 'BeginnEsckrima',
            // 'EndeEsckrima',

        ],
    ]); ?>
     </div><!-- content -->
  </div> <!-- col -->
</div> <!-- row -->
