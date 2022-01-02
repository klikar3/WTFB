<?php

//use yii\helpers\Html;
use yii\bootstrap4\Html;
use yii\helpers\Url;
//use yii\grid\GridView;

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliederSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Mitglieder');
$this->params['breadcrumbs'][] = $this->title;
?>
<div clas="card">
  <div class="card-header text-white border-primary bg-info">
    <h5><?= Html::encode($this->title) ?></h5>
  </div>
  <div class="card-body border-primary bg-light">
    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Mitglieder',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'MitgliederId',
            'MitgliedsNr',
            'Vorname',
            'Name',
            'Geschlecht',
            'RecDeleted',
            // 'Anrede',
            // 'GeburtsDatum',
            // 'PLZ',
            // 'Wohnort',
            // 'Strasse',
            // 'Telefon1',
            // 'Telefon2',
            // 'HandyNr',
            // 'Fax',
            // 'LetzteAenderung',
            // 'Email:email',
            // 'Beruf',
            // 'Nationalitaet',
            // 'BLZ',
            // 'Bank',
            // 'KontoNr',
            // 'Status',
            // 'AktivPassiv',
            // 'Kontoinhaber',
            'Schulort',
            // 'Disziplin',
            // 'Funktion',
            // 'Sifu',
            // 'Woher',
            // 'Graduierung',
            // 'VDauer',
            // 'Monatsbeitrag',
            // 'BeitrittDatum',
            // 'KuendigungDatum',
            // 'AustrittDatum',
            // 'Geburtsort',
            // 'GruppenArt',
            // 'Zahlungsart',
            // 'Zahlungsweise',
            // 'EinzugZum',
            // 'AufnahmegebuehrBezahlt',
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
            // 'datumWtPraktikum',
            // 'datumWtAusbilder1',
            // 'datumWtAusbilder2',
            // 'datumWtAusbilder3',
            // 'datumWtSchulleiter',
            // 'AufnGebuehrBetrag',
            // 'SFirm',
            // 'BListe',
            // 'DVDgesendetAm',
            // 'EsckrimaGraduierung',
            // 'BeginnEsckrima',
            // 'EndeEsckrima',

            ['class' => 'yii\grid\ActionColumn',
    						'template' => '{view}  {update}  {delete}  {restore} ',
//								'controller' => 'texte',
								'header' => '<center>Aktion</center>',
                 'options' => [
                    'style' => 'width:70px;',
                ],
								'buttons' => [ 
                    'view' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-eye"></i>', 
                           ['view', 'id' => $model->MitgliederId],
                        );  // view record
                    },
									'delete' => function ($url, $model) {
										return ''.Html::a('<span class="fa fa-trash"></span>', 
																	Url::toRoute(['/mitglieder/delete-admin', 'id' => $model->MitgliederId ] ), [
      			          'data' => [
      			              'confirm' => Yii::t('app', 'Soll dieser Datensatz wirklich gelöscht werden?  Wurde vorher ein Backup gemacht? Ein Backup kostet nix!!!'),
      			              'method' => 'post',
          			          ],
//            					'target'=>'_blank',
											'title' => Yii::t('app', 'Datensatz wirklich aus der DB löschen'),
								        ])  . '';
								    },
									'restore' => function ($url, $model) {
										return ''.Html::a('<span class="fa fa-external-link-alt"></span>', 
																	Url::toRoute(['/mitglieder/restore', 'id' => $model->MitgliederId ] ), [
      			          'data' => [
      			              'confirm' => Yii::t('app', 'Soll dieser Datensatz wirklich wiederhergestellt werden?'),
      			              'method' => 'post',
          			          ],
//            					'target'=>'_blank',
											'title' => Yii::t('app', 'Datensatz wirklich wiederherstellen'),
								        ])  . '';
								    },
                    'update'=> function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-edit"></i>', 
                           ['/mitglieder/update_only', 'id' => $model->MitgliederId],
                        );  // update record
                    },
								],
							],
        ],
    ]); ?>

</div>
