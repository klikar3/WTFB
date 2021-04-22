<?php

//use yii\helpers\ArrayHelper;
//use yii\helpers\Html;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;

//use kartik\detail\DetailView;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\datecontrol;
//use kartik\widgets\DatePicker;

//use frontend\models\Mitgliedergrade;
use frontend\models\Mitgliederschulen;
//use frontend\models\Disziplinen;
//use frontend\models\DisziplinenSearch;
//use frontend\models\Grade;
//use frontend\models\GradeSearch;
//use frontend\models\Pruefer;
//use frontend\models\Schulen;
 
/* @var $this yii\web\View */
/* @var $model frontend\models\Mitglieder */

?>      
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

<div class="card border-info panel panel-info" style="font-size:0.9em;">
	<div class="card-header border-info my-card bg-info panel-heading" style="margin-bottom: 0px;height:3.5em;">
    <div class="row" style="color:black;"> 
      <div class="col-2">
					<h5 style="color: white;">Verträge </h5>
      </div> 
      <div class="col-2">
				 <?php 
            PopoverX::begin([ 'id' => 'mg-cr-vgv',
                					'header' => $header,
            'type' => PopoverX::TYPE_INFO,
            'placement' => PopoverX::ALIGN_BOTTOM,
						'size'=>'lg',					
            'headerOptions' => ['style' => 'background-color: #E8F0FD !important;'],
                //									'headerOptions' => ['style' => 'height:1.5em'],
                					'toggleButton' => ['label' => '<i class="fa fa-plus"></i>', 'class' => 'btn btn-success',],
                //	 								'footer'=> Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default']) . Html::submitButton('Speichern', ['class'=>'btn btn-sm btn-primary'])."</a>",
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
									<?=  $form->field($ms, 'MitgliederId')->hiddenInput()->label(false); ?> 
									<?= $form->field($ms, 'VDatum',['labelSpan' => 4])->widget(datecontrol::classname(),
											[ 'type' => datecontrol::FORMAT_DATE,
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
									<?= $form->field($ms, 'Von',['labelSpan' => 4])->widget(datecontrol::classname(),
											[ 'type' => datecontrol::FORMAT_DATE,
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

    								<?= $form->field($ms, 'SchulId',['labelSpan' => 4])->dropdownList($schulen,
																			[ 'prompt' => Yii::t('app', 'School') ]
																		) ?>
    								<?= $form->field($ms, 'VDauerMonate',['labelSpan' => 4])->dropdownList(range( 0, 36, 1 ) ,
																			[ 'prompt' => Yii::t('app', 'Contract Duration in Months') ]
																		) ?>
    								<?= $form->field($ms, 'KFristMonate',['labelSpan' => 4])->dropdownList(range( 0, 6, 1 ) ,
																			[ 'prompt' => Yii::t('app', 'Kündigungsfrist in Monaten') ]
																		) ?>
    								<?= $form->field($ms, 'VerlaengerungMonate',['labelSpan' => 4])->dropdownList(range( 0, 36, 1 ) ,
																			[ 'prompt' => Yii::t('app', 'Contract Extension (months)') ]
																		) ?>
    								<?= $form->field($ms, 'MonatsBeitrag',['labelSpan' => 4])->textInput(
																			[ 'placeholder' => Yii::t('app', 'Monthly contribution') ]
																		) ?>
    								<?= $form->field($ms, 'AGebuehr',['labelSpan' => 4])->textInput(
																			[ 'placeholder' => Yii::t('app', 'Monthly Fee') ]
																		) ?>
    								<?= $form->field($ms, 'ZahlungsArt',['labelSpan' => 4])->dropdownList(array_merge(["" => ""], ['Bankeinzug'=> Yii::t('app', 'Direct Debit'), 'Bar'=>Yii::t('app', 'Cash'), 'Überweisung' => Yii::t('app', 'Transfer')]) ,
																			[ 'prompt' => Yii::t('app', 'Payment Method') ]
																		) ?>
    								<?= $form->field($ms, 'Zahlungsweise',['labelSpan' => 4])->dropdownList(array_merge(["" => ""], ['monatlich'=> Yii::t('app', 'monthly'), 'vierteljährlich' => Yii::t('app', 'quarterly'), 'halbjährlich' => Yii::t('app', 'half-yearly'), 'jährlich' => Yii::t('app', 'yearly')]) ,
																			[ 'prompt' => Yii::t('app', 'Payment Type') ]
																		) ?>
										<div style="text-align:right;"> <br>
										<?= Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default']) . "   " .Html::submitButton(Yii::t('app', 'Speichern'), ['class'=>'btn btn-sm btn-primary'])."</a>"
										?>
										</div>
							<?php $form = ActiveForm::end(); ?>
							<?php PopoverX::end();?>
            </div>
          </div>
			</div>				
	<div class="card-body bg-light border-info">	
	<?= GridView::widget([
	        'dataProvider' => $contracts,
	        'responsiveWrap' => false,
				  'condensed'=>true,
          'pjax'=>true,
          'options' => ['id' => 'exp_grid_vertrag',
          ], 
			    'formatter' => [
			        'class' => 'yii\i18n\Formatter',
			        'nullDisplay' => '',
			    ],
//					'headerRowOptions' => [ 'style' => 'font-size:0.85em',
//					],
//					'rowOptions' => [ 'style' => 'font-size:0.85em',
//					],
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
								'detail' => function ($data, $key, $index, $column) use ($formedit, $schulen) {
	                return Yii::$app->controller->renderPartial('/mitglieder/_vertrag-detail', ['model'=>$data, 'formedit' => $formedit, 'schulen' => $schulen,
                                                                                              's' => $data->schul->SchulDisp]);
            		},
            		'enableRowClick' => true,
                'hidden' => false,
                'detailRowCssClass' => 'wtfb-light',
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
										return '<center>'.Html::a('<span class="fa fa-trash"></span>', 
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
      											'style' => 'overflow-y:scroll;height:800px;text-size:0.85em;',
  											],
					],				
	    ]); ?>
		</div>
 </div>
