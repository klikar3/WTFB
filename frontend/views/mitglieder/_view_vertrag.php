<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;

use frontend\models\Mitgliedergrade;
use frontend\models\Mitgliederschulen;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Pruefer;
use frontend\models\Schulen;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>
    <p>
				<div class="row">
					<div class="col-sm-5">
						<div style="margin-top: 20px">
							<?php
								$ms = new MitgliederSchulen();
								$datum = date('d.m.Y');
        				$ms->Von = $datum;
                $ms->MitgliederId = $model->MitgliederId;
              ?>
    						<?php $form = ActiveForm::begin(['action' => ['mitgliederschulen/createfast'],
    																							'fieldConfig'=>['showLabels'=>true],
																									'type' => ActiveForm::TYPE_HORIZONTAL,							
																								]); ?>
								<?php Modal::begin([ 
									'header' => '<h2>Neuen Schulvertrag zuweisen</h2>',
									'toggleButton' => ['label' => 'Schulvertrag zuweisen', 'class' => 'btn btn-primary'],
	 								'footer'=>Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) .
														Html::resetButton('Reset', ['class'=>'btn btn-sm btn-default'])
							]);
							?>
							<div class="row" style="margin-bottom: 8px">
								<div class="col-sm-10">
							<?=  $form->field($ms, 'MitgliederId')->textInput(['disabled' => true]); ?>
								</div>
								<div class="col-sm-10">
									<?= $form->field($ms, 'Von')->widget(DatePicker::classname(),
									[ 'value' => date('d.m.Y'), 'options'=>['placeholder'=>'Graduierungsdatum'], 'pluginOptions'=>['autoclose'=>true, 'format' => 'dd.mm.yyyy',
'todayHighlight' => true, 'todayBtn' => true,
]]); ?>
								</div>
								<div class="col-sm-10">
	    <?= $form->field($ms, 'Bis')->dropdownList(ArrayHelper::map( Pruefer::find()->all(), 'prueferId', 'pName' ),
[ 'prompt' => 'Pruefer' ]
) ?>
								</div>
								<div class="col-sm-10">
    <?= $form->field($ms, 'SchulId')->dropdownList(ArrayHelper::map( Schulen::find()->all(), 'SchulId', 'Schulname', 'Disziplin' ),
[ 'prompt' => 'Grad' ]
) ?>
								</div>
							</div>
							<?php Modal::end();?>
							<?php $form = ActiveForm::end(); ?>
						</div>
					</div>
				</div>		
	</p>
	<?= GridView::widget([
	        'dataProvider' => $contracts,
	        'columns' => [
//	            'msID',
//							'MitgliederId', 
							[ 'attribute' => 'Schule', 'value' => 'schul.Schulname' ],
							[ 'attribute' => 'Disziplin', 'value' => 'schul.disziplinen.DispKurz', 'label' => 'Disz.' ],
							[ 'attribute' => 'Von', 'value' => 'Von', 'format' => ['date', 'php:d.m.Y'] ],
							[ 'attribute' => 'Bis', 'value' => 'Bis', 'format' => ['date', 'php:d.m.Y'] ],
							[ 'attribute' => 'KuendigungAm', 'value' => 'KuendigungAm', 'format' => ['date', 'php:d.m.Y'] ],
							[ 'attribute' => 'VDauerMonate', 'value' => 'VDauerMonate' ],
							[ 'attribute' => 'MonatsBeitrag', 'value' => 'MonatsBeitrag' ],
							[ 'attribute' => 'ZahlungsArt', 'value' => 'ZahlungsArt' ],
							[ 'attribute' => 'Zahlungsweise', 'value' => 'Zahlungsweise' ],
							[ 'attribute' => 'BeitragAussetzenVon', 'value' => 'BeitragAussetzenVon', 'format' => ['date', 'php:d.m.Y'] ],
							[ 'attribute' => 'BeitragAussetzenBis', 'value' => 'BeitragAussetzenBis', 'format' => ['date', 'php:d.m.Y'] ],
							[ 'attribute' => 'BeitragAussetzenGrund', 'value' => 'BeitragAussetzenGrund' ],
							[ 'attribute' => 'VertragId', 'value' => 'VertragId' ],
							
            	[ 'class' => 'yii\grid\ActionColumn',
            						'template' => '{view}',
												'controller' => 'mitgliederschulen',
//												'width' => '60px',
							],
				],
	    ]); ?>



    <?php /*echo DetailView::widget([
    		'id' => 'dv_vv',
        'model' => $model,
				'condensed'=>true,
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}',
				'panel'=>[
					'heading'=>'Mitglied # ' . $model->MitgliedsNr,
					'type'=>DetailView::TYPE_INFO,
				],
        'attributes' => [
             'VDauer',
             'Monatsbeitrag',
             'BeitrittDatum',
             'KuendigungDatum',
             'AustrittDatum',
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
    ]); */ ?>
