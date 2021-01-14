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
					<div class="panel-heading" style="margin-bottom: 0px;height:3em;">
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
					<?= '<h5 style="padding-top:0em;margin-top:0em;">Verträge&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?>
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
							<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
							</div>
							<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
									<?=  $form->field($ms, 'MitgliederId')->hiddenInput()->label(false); ?> 
									<?= $form->field($ms, 'VDatum')->widget(DateControl::classname(),
											[ 'type' => DateControl::FORMAT_DATE,
 												'ajaxConversion'=>true,
        	 							'displayFormat' => 'php:d.m.Y',
        	 							'saveFormat' => 'php:Y-m-d',
												'widgetOptions'=>[
														'id' => 'vd_feld',
														'pluginOptions'=>[ 'autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true],
                            'options' => [
                                'placeholder' => Yii::t('app', 'Contract Conclusion Date'),
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
                                'placeholder' => Yii::t('app', 'Entry Date'),
                            ],
												],
											]); ?>

    								<?= $form->field($ms, 'SchulId')->dropdownList(ArrayHelper::map( Schulen::find()->with('disziplinen')->orderBy('sort')->all(), 'SchulId', 'SchulDisp' ),
																			[ 'prompt' => Yii::t('app', 'School') ]
																		) ?>
    								<?= $form->field($ms, 'VDauerMonate')->dropdownList(range( 0, 36, 1 ) ,
																			[ 'prompt' => Yii::t('app', 'Contract Duration in Months') ]
																		) ?>
    								<?= $form->field($ms, 'KFristMonate')->dropdownList(range( 0, 6, 1 ) ,
																			[ 'prompt' => Yii::t('app', 'Kündigungsfrist in Monaten') ]
																		) ?>
    								<?= $form->field($ms, 'VerlaengerungMonate')->dropdownList(range( 0, 36, 1 ) ,
																			[ 'prompt' => Yii::t('app', 'Contract Extension (months)') ]
																		) ?>
    								<?= $form->field($ms, 'MonatsBeitrag')->textInput(
																			[ 'placeholder' => Yii::t('app', 'Monthly contribution') ]
																		) ?>
    								<?= $form->field($ms, 'AGebuehr')->textInput(
																			[ 'placeholder' => Yii::t('app', 'Monthly Fee') ]
																		) ?>
    								<?= $form->field($ms, 'ZahlungsArt')->dropdownList(array_merge(["" => ""], ['Bankeinzug'=> Yii::t('app', 'Direct Debit'), 'Bar'=>Yii::t('app', 'Cash'), 'Überweisung' => Yii::t('app', 'Transfer')]) ,
																			[ 'prompt' => Yii::t('app', 'Payment Method') ]
																		) ?>
    								<?= $form->field($ms, 'Zahlungsweise')->dropdownList(array_merge(["" => ""], ['monatlich'=> Yii::t('app', 'monthly'), 'vierteljährlich' => Yii::t('app', 'quarterly'), 'halbjährlich' => Yii::t('app', 'half-yearly'), 'jährlich' => Yii::t('app', 'yearly')]) ,
																			[ 'prompt' => Yii::t('app', 'Payment Type') ]
																		) ?>
										<div style="text-align:right;"> <br>
										<?= Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default']) . "   " .Html::submitButton(Yii::t('app', 'Speichern'), ['class'=>'btn btn-sm btn-primary'])."</a>"
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
          'pjax'=>true,
          'options' => ['id' => 'exp_grid_vertrag',
          ], 
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
							[ 'class' => '\kartik\grid\ExpandRowColumn', 
                'value' => function ($data, $key, $index, $column ) use ($openv) { 
                			return	($data->msID == $openv) ? GridView::ROW_EXPANDED : GridView::ROW_COLLAPSED;
/*                				if ($data->msID == $openv) 
													return GridView::ROW_EXPANDED;
												else 	
                        	return GridView::ROW_COLLAPSED;
*/                    }
										,
								'detail' => function ($data, $key, $index, $column) {
	                return Yii::$app->controller->renderPartial('/mitglieder/_vertrag-detail', ['model'=>$data]);
            		},
            		'enableRowClick' => true,
                'hidden' => false,
							],
							[ 'attribute' => 'Schule', 'value' => 'schul.Schulname', 'label' => Yii::t('app', 'School') ],
							[ 'attribute' => 'Disziplin', 'value' => 'schul.disziplinen.DispKurz', 'label' => Yii::t('app', 'Discipline') ],
							[ 'attribute' => 'VDatum', 'value' => 'VDatum', 'format' => ['date', 'php:d.m.Y'] ],
							[ 'attribute' => 'Von', 'value' => 'Von', 'format' => ['date', 'php:d.m.Y'] ],
							[ 'attribute' => 'Bis', 'value' => 'Bis', 'format' => ['date', 'php:d.m.Y'] ],
            	[ 'class' => 'yii\grid\ActionColumn',
    						'template' => '{delete}',
								'controller' => 'mitgliederschulen',
								'header' => '<center>Aktion</center>',
                'header' => Yii::t('app', 'Actions'),
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


