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
			<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-info"><div class="panel-heading">
							<?php
								$ms = new MitgliederSchulen();
								$datum = date('php:Y-m-d');
        				$ms->Von = $datum;
                $ms->MitgliederId = $model->MitgliederId;
                $ms->VDauerMonate = 12;
                $ms->MonatsBeitrag = 48.00;
                $ms->ZahlungsArt = 'Bankeinzug';
                $ms->Zahlungsweise = 'monatlich';
                $header = '<center><h3>Neuen Schulvertrag zuweisen an<br>'.$model->Name.', '.$model->Vorname.'</h3></center>';
              ?>
    						<?php $form = ActiveForm::begin(['action' => ['mitgliederschulen/createfast'],
    																							'fieldConfig'=>['showLabels'=>true],
																									'type' => ActiveForm::TYPE_HORIZONTAL,							
																									 'id' => 'login-form-horizontal',
																									'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL,
																									'showErrors' => true,
																									]
																								]); ?>
								 <?= 'Mitglied: ' . $model->Name . ', ' . $model->Vorname . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?>
								 <?php Modal::begin([ 
									'header' => $header,
									'toggleButton' => ['label' => 'Schulvertrag zuweisen', 'class' => 'btn btn-sm btn-primary'],
	 								'footer'=>Html::submitButton('Speichern', ['class'=>'btn btn-sm btn-primary']) .
														Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default'])
							]);
							?>
							<div class="row" style="margin-bottom: 8px">
								<div class="col-sm-10">
									<?=  $form->field($ms, 'MitgliederId')->hiddenInput()->label(''); ?> 
									<?= $form->field($ms, 'Von')->widget(DateControl::classname(),
											[ //'value' => date('d.m.Y'), 
												'type' => DateControl::FORMAT_DATE,
 												'ajaxConversion'=>true,
// 												'displayTimezone' => 'Europe/Berlin',
//									    'displayFormat' => 'php:d.m.Y',
//										    'saveFormat' => 'php:Y-m-d',
												'options'=>[
//														'placeholder' => 'Beginn',
														'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
														
												],
											]); ?>
								</div>
								<div class="col-sm-10">
	    <?= $form->field($ms, 'Bis')->widget(DatePicker::classname(),
									[ 'value' => date('d.m.Y'), 'options'=>['placeholder'=>'Ende'], 'pluginOptions'=>['autoclose'=>true, 'format' => 'dd.mm.yyyy',
'todayHighlight' => true, 'todayBtn' => true,
]]) ?>
								</div>
								<div class="col-sm-10">
    <?= $form->field($ms, 'SchulId')->dropdownList(ArrayHelper::map( Schulen::find()->all(), 'SchulId', 'SchulDisp' ),
[ 'prompt' => 'Schule' ]
) ?>
								</div>
								<div class="col-sm-10">
    								<?= $form->field($ms, 'VDauerMonate')->dropdownList(range( 0, 36, 1 ) ,
																			[ 'prompt' => 'Vertragsdauer in Monaten' ]
																		) ?>
								</div>
								<div class="col-sm-10">
    								<?= $form->field($ms, 'MonatsBeitrag')->textInput(
																			[ 'prompt' => 'MonatsBeitrag' ]
																		) ?>
								</div>
								<div class="col-sm-10">
    								<?= $form->field($ms, 'ZahlungsArt')->dropdownList(array_merge(["" => ""], ['Bankeinzug'=>'Bankeinzug','Bar'=>'Bar']) ,
																			[ 'prompt' => 'Zahlungsart' ]
																		) ?>
								</div>
								<div class="col-sm-10">
    								<?= $form->field($ms, 'Zahlungsweise')->dropdownList(array_merge(["" => ""], ['monatlich'=>'monatlich','vierteljährlich'=>'vierteljährlich','halbjährlich'=>'halbjährlich','jährlich'=>'jährlich']) ,
																			[ 'prompt' => 'Zahlungsweise' ]
																		) ?>
								</div>
							</div>
							<?php Modal::end();?>
							<?php $form = ActiveForm::end(); ?>
						</div>
			</div>		
	</div>
</div>

	<?= GridView::widget([
	        'dataProvider' => $contracts,
	        'columns' => [
//	            'msID',
//							'MitgliederId', 
            	[ 'class' => 'yii\grid\ActionColumn',
            						'template' => '{view}',
												'controller' => 'mitgliederschulen',
//												'width' => '60px',
							],
							[ 'class' => '\kartik\grid\ExpandRowColumn', 
                'value' => function ($data, $model, $key, $index) { 
                        return GridView::ROW_COLLAPSED;
                    },
								'detail' => function ($data, $id) {
								$cont = Mitgliederschulen::findOne($id);
                return Yii::$app->controller->renderPartial('_vertrag-detail', ['model'=>$cont]);
            		},
							],
							[ 'attribute' => 'Schule', 'value' => 'schul.Schulname' ],
							[ 'attribute' => 'Disziplin', 'value' => 'schul.disziplinen.DispKurz', 'label' => 'Disz.' ],
							[ 'attribute' => 'Von', 'value' => 'Von', 'format' => ['date', 'php:d.m.Y'] ],
							[ 'attribute' => 'Bis', 'value' => 'Bis', 'format' => ['date', 'php:d.m.Y'] ],
/*							[ 'attribute' => 'KuendigungAm', 'value' => 'KuendigungAm', 'format' => ['date', 'php:d.m.Y'] ],
							[ 'attribute' => 'VDauerMonate', 'value' => 'VDauerMonate' ],
							[ 'attribute' => 'MonatsBeitrag', 'value' => 'MonatsBeitrag' ],
							[ 'attribute' => 'ZahlungsArt', 'value' => 'ZahlungsArt' ],
							[ 'attribute' => 'Zahlungsweise', 'value' => 'Zahlungsweise' ],
							[ 'attribute' => 'BeitragAussetzenVon', 'value' => 'BeitragAussetzenVon', 'format' => ['date', 'php:d.m.Y'] ],
							[ 'attribute' => 'BeitragAussetzenBis', 'value' => 'BeitragAussetzenBis', 'format' => ['date', 'php:d.m.Y'] ],
							[ 'attribute' => 'BeitragAussetzenGrund', 'value' => 'BeitragAussetzenGrund' ],
							[ 'attribute' => 'VertragId', 'value' => 'VertragId' ],
*/            	[ 'class' => 'yii\grid\ActionColumn',
            						'template' => '{delete}',
												'controller' => 'mitgliederschulen',
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

        ],
    ]); */ ?>
