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

				<div class="panel panel-info" style="font-size:0.9em;height:3em;">
					<div class="panel-heading panel-xs" style="margin-bottom: 0px;height:3em;">
							<?php
								$datum = date('Y-m-d');
								$ms = new MitgliederSchulen();
//        				$ms->Von = $datum;
//                $ms->VDatum = $datum;
                $ms->MitgliederId = $model->MitgliederId;
//                $ms->VDauerMonate = 12;
                $ms->MonatsBeitrag = null;
//                $ms->ZahlungsArt = 'Bankeinzug';
//                $ms->Zahlungsweise = 'monatlich';
                $header = '<center><h5>Neuen Schulvertrag für '.$model->Name.', '.$model->Vorname.'</h5></center><a size="0.9em">';
              ?>
					<?= '<h5 style="padding-top:0em;margin-top:0em;">' . $model->Name . ', ' . $model->Vorname . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?>
								 <?php Modal::begin([ 'id' => 'mg-cr-vgv',
									'header' => $header,
//									'headerOptions' => ['style' => 'height:1.5em'],
									'toggleButton' => ['label' => '<i class="fa glyphicon glyphicon-plus"></i>', 'class' => 'btn btn-primary', 'style'=>"padding-top:0.1em;margin-top:0em;"],
//	 								'footer'=> Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default']) . Html::submitButton('Speichern', ['class'=>'btn btn-sm btn-primary'])."</a>",
									'size'=>'modal-md',					
							]);
							?> 
    						<?php $form = ActiveForm::begin(['action' => ['mitgliederschulen/createfast'],
																									'enableClientValidation' => true,
																									'enableAjaxValidation' => false,
    																							'fieldConfig'=>['showLabels'=>true],
																									'type' => ActiveForm::TYPE_HORIZONTAL,							
																									'id' => 'login-form-horizontal',
																									'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM,
																										'showErrors' => true,
																									]
																								]); ?>
							<div class="row">																	
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							</div>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
									<?=  $form->field($ms, 'MitgliederId')->hiddenInput()->label(''); ?> 
									<?= $form->field($ms, 'VDatum')->widget(DateControl::classname(),
											[ 'type' => DateControl::FORMAT_DATE,
 												'ajaxConversion'=>true,
        	 							'displayFormat' => 'php:d.m.Y',
        	 							'saveFormat' => 'php:Y-m-d',
												'widgetOptions'=>[
														'id' => 'vd_feld',
														'pluginOptions'=>[ 'autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true],
                            'options' => [
                                'placeholder' => 'Vertrags-Abschlussdatum',
                            ],														
												],
											]); ?>
									<?= $form->field($ms, 'Von')->widget(DateControl::classname(),
											[ 'type' => DateControl::FORMAT_DATE,
 												'ajaxConversion'=>true,
// 												'displayTimezone' => 'Europe/Berlin',
        	 							'displayFormat' => 'php:d.m.Y',
        	 							'saveFormat' => 'php:Y-m-d',
												'widgetOptions'=>[
														'id' => 'von_feld',
														'pluginOptions'=>[ 'autoclose'=>true, 'todayHighlight' => false, 'todayBtn' => true],														
                            'options' => [
                                'placeholder' => 'Eintrittsdatum',
                            ],
												],
											]); ?>

    								<?= $form->field($ms, 'SchulId')->dropdownList(ArrayHelper::map( Schulen::find()->all(), 'SchulId', 'SchulId' ),
																			[ 'prompt' => 'Schule' ]
																		) ?>
    								<?= $form->field($ms, 'VDauerMonate')->dropdownList(range( 0, 36, 1 ) ,
																			[ 'prompt' => 'Vertragsdauer in Monaten' ]
																		) ?>
    								<?= $form->field($ms, 'MonatsBeitrag')->textInput(
																			[ 'placeholder' => 'MonatsBeitrag' ]
																		) ?>
    								<?= $form->field($ms, 'ZahlungsArt')->dropdownList(array_merge(["" => ""], ['Bankeinzug'=>'Bankeinzug','Bar'=>'Bar', 'Überweisung' => 'Überweisung']) ,
																			[ 'prompt' => 'Zahlungsart' ]
																		) ?>
    								<?= $form->field($ms, 'Zahlungsweise')->dropdownList(array_merge(["" => ""], ['monatlich'=>'monatlich','vierteljährlich'=>'vierteljährlich','halbjährlich'=>'halbjährlich','jährlich'=>'jährlich']) ,
																			[ 'prompt' => 'Zahlungsweise' ]
																		) ?>
										<div style="text-align:right;"> <br>
										<?= Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default']) . "   " .Html::submitButton('Speichern', ['class'=>'btn btn-sm btn-primary'])."</a>"
										?>
										</div>
								</div>										
								</div>										
							<?php $form = ActiveForm::end(); ?>
							<?php Modal::end();?>
			</div></h5>				
		</div>		
	<?= GridView::widget([
	        'dataProvider' => $contracts,
	        'responsiveWrap' => false,
			    'formatter' => [
			        'class' => 'yii\i18n\Formatter',
			        'nullDisplay' => '',
			    ],
					'headerRowOptions' => [ 'style' => 'font-size:0.85em',
					],
					'rowOptions' => [ 'style' => 'font-size:0.85em',
					],
	        'columns' => [
//	            'msID',
//							'MitgliederId', 
/*            	[ 'class' => '\kartik\grid\ActionColumn',
      						'template' => '{Ausweis}{Begruessung}{Aussetzen}{Kuendigung}{standard}',
									'controller' => 'mitgliederschulen',
									'dropdown' => true,
									'hidden' => !Yii::$app->user->identity->isAdmin,
			            'buttons' => [
			               'Ausweis' => function ($url, $model) {
        										return Html::a('<p><span class="glyphicon glyphicon-print"></span>Ausweis drucken</p>', 
															Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
													 				'txtid' => 1 ] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Ausweis drucken'),
												        ]);
			                },
			               'Begruessung' => function ($url, $model) {
        										return Html::a('<p><span class="glyphicon glyphicon-print"></span>Begrüßung drucken</p>',  
															Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
													 				'txtid' => 2 ] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Begrüßung drucken'),
												        ]);
			                },
       							'Aussetzen' => function ($url, $model) {
        										return Html::a('<p><span class="glyphicon glyphicon-print"></span>Aussetzen drucken</p>',  
															Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
													 				'txtid' => 3 ] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Aussetzen drucken'),
												        ]);
			                },
			               'Kuendigung' => function ($url, $model) {
        										return Html::a('<p><span class="glyphicon glyphicon-print"></span>Kündigung drucken</p>',  
															Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
													 				'txtid' => 4 ] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Kündigung drucken'),
												        ]);
			                },
			               'standard' => function ($url, $model) {
        										return Html::a('<p><span class="glyphicon glyphicon-print"></span>Standard-Email drucken</p>',  
															Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
													 				'txtid' => 5 ] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Standard-Email drucken'),
												        ]);
			                },
			            ],
//								'width' => '60px',
							],
*/							
							[ 'class' => '\kartik\grid\ExpandRowColumn', 
                'value' => function ($data, $model, $key, $index ) use ($openv) { 
//                				($data->msID == $openv) ? GridView::ROW_EXPANDED : GridView::ROW_COLLAPSED;
                				if ($data->msID == $openv) 
													return GridView::ROW_EXPANDED;
												else 	
                        	return GridView::ROW_COLLAPSED;
                    }
										,
								'detail' => function ($data, $model, $key, $index) {//function ($data, $id) {
									//$cont = Mitgliederschulen::findOne($id);
	                return Yii::$app->controller->renderPartial('_vertrag-detail', ['model'=>$data]);
            		},
            		'enableRowClick' => true,
							],
							[ 'attribute' => 'Schule', 'value' => 'schul.Schulname' ],
							[ 'attribute' => 'Disziplin', 'value' => 'schul.disziplinen.DispKurz', 'label' => 'Disziplin' ],
							[ 'attribute' => 'VDatum', 'value' => 'VDatum', 'format' => ['date', 'php:d.m.Y'] ],
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
												'header' => '<center>Aktion</center>',
												'buttons' => [ 
													'delete' => function ($url, $model) {
														return '<center>'.Html::a('<span class="glyphicon glyphicon-trash"></span>', 
																					Url::toRoute(['mitgliederschulen/deletefast', 'id' => $model->msID] ), [
				//	          					'target'=>'_blank',
															'data-confirm' => 'Soll der Vertrag wirklich gelöscht werden?',
															'title' => Yii::t('app', 'Vertrag löschen'),
												        ]) . '</center>';
												    },
												],
							],

				],
    			'options' => ['htmlOptions' => [
      											'style' => 'overflow-y:scroll;height:800px;text-size:0.8em;',
  											],
					],				
	    ]); ?>


