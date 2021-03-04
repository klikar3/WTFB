<?php

//use yii\helpers\Html;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MitgliederSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Intensiv-Mitglieder');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitglieder-index modal-content" style="overflow-x:auto;padding:5px;">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Mitglieder',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['style' => 'font-size:9pt'],
//        'options' => [ 'style' => 'table-layout:fixed;' ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn',
    						'template' => '{view}  {update}  {delete}  {restore}',
								'header' => '<center>Aktion</center>',
                 'options' => [
                    'style' => 'width:70px;',
                ],
								'buttons' => [ 
									'delete' => function ($url, $model) {
										return ''.Html::a('<span class="glyphicon glyphicon-trash"></span>', 
																	Url::toRoute(['/mitglieder/delete-admin', 'id' => $model->MitgliederId ] ), [
      			          'data' => [
      			              'confirm' => Yii::t('app', 'Soll dieser Datensatz wirklich gelöscht werden?  Wurde vorher ein Backup gemacht? Ein Backup kostet nix!!!'),
      			              'method' => 'post',
          			          ],
											'title' => Yii::t('app', 'Datensatz wirklich aus der DB löschen'),
								        ])  . '';
								    },
									'restore' => function ($url, $model) {
										return ''.Html::a('<span class="glyphicon glyphicon-new-window"></span>', 
																	Url::toRoute(['/mitglieder/restore', 'id' => $model->MitgliederId ] ), [
      			          'data' => [
      			              'confirm' => Yii::t('app', 'Soll dieser Datensatz wirklich wiederhergestellt werden?'),
      			              'method' => 'post',
          			          ],
//            					'target'=>'_blank',
											'title' => Yii::t('app', 'Datensatz wirklich wiederherstellen'),
								        ])  . '';
								    },
									'update' => function ($url, $model) {
										return ''.Html::a('<span class="glyphicon glyphicon-edit"></span>', 
																	Url::toRoute(['/mitglieder/view', 'id' => $model->MitgliederId, 'tabnum' => 1 ] ), [
											'title' => Yii::t('app', 'Intensiv'),
								        ])  . '';
								    },
								],
							],

            'Vorname',
            'Name',
            'einstufung',
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
            [ 'attribute' => 'mitgliederIntensiv.KontaktAm',
              'label' => 'Wie',
              'value' => function ($model) {
                            return 'KontaktAm: ' . (empty($model->mitgliederIntensiv->KontaktAm) ? '' : \DateTime::createFromFormat('Y-m-d', $model->mitgliederIntensiv->KontaktAm)->format('d.m.Y')) . ' KontaktArt: ' . $model->mitgliederIntensiv->KontaktArt . ' Woher: ' . $model->mitgliederIntensiv->Woher;
                         }   
            ], 
    //        'mitgliederIntensiv.KontaktArt', 
    //        'mitgliederIntensiv.Woher',
            [ 'attribute' => 'mitgliederIntensiv.kontaktNachricht',
              'label' => 'Kontaktnachricht',
              'format' => 'ntext',
              'headerOptions' => ['style' => 'min-width:300px', 'width' => '300'],
              'contentOptions' => ['style' => 'font-size:8pt'],
            ],
            [ 'attribute' => 'mitgliederIntensiv.telefonatAm', 
              'label' => 'Telefonat',
            ],
            [ 'attribute' => 'mitgliederIntensiv.alter',
              'label' => 'Alter',
            ],
            [ 'attribute' => 'mitgliederIntensiv.graduierung',
              'label' => 'Grad',
            ],
            [ 'attribute' => 'mitgliederIntensiv.wieLangeWt',
              'label' => 'WT-Dauer',
            ],
            [ 'attribute' => 'mitgliederIntensiv.ausbQuali',
              'label' => 'Ausb.-Quali',
            ],
            [ 'attribute' => 'mitgliederIntensiv.unterrichtet',
              'label' => 'unterr',
            ],
            [ 'attribute' => 'mitgliederIntensiv.eigeneSchule',
              'label' => 'Schule',
            ],
            [ 'attribute' => 'mitgliederIntensiv.eigeneLehrer',
              'label' => 'eigeneLehrer',
            ],
            [ 'attribute' => 'mitgliederIntensiv.organisation',
              'label' => 'Organis.',
            ],
            [ 'attribute' => 'mitgliederIntensiv.erfAndereStile',
              'label' => 'ErfAndereStile',
            ],
            [ 'attribute' => 'mitgliederIntensiv.ziel',
              'label' => 'Ziel',
            ],
            [ 'attribute' => 'mitgliederIntensiv.wievielZeit',
              'label' => 'wievielZeit',
            ],
            [ 'attribute' => 'mitgliederIntensiv.trainingsPartner',
              'label' => 'T-Partner',
            ],
            [ 'attribute' => 'mitgliederIntensiv.erstTermin',
              'label' => 'erstTermin',
            ],
            [ 'attribute' => 'mitgliederIntensiv.bemerkung',
              'format' => 'ntext',
              'label' => 'Bemerkung',
              'headerOptions' => ['style' => 'min-width:300px', 'width' => '300'],
              'contentOptions' => ['style' => 'font-size:8pt'],
            ],
            'Schulort',
            'Geschlecht',
            [ 'attribute' => 'MitgliederId'],
            'RecDeleted',

        ],
    ]); ?>

</div>
