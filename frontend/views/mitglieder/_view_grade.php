<?php

use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\VarDumper;

use kartik\detail\DetailView;
use kartik\grid\GridView;
use kartik\popover\PopoverX;
use kartik\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
//use kartik\widgets\DatePicker;

use frontend\models\Mitgliedergrade;
use frontend\models\MitgliedergradePrint;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Pruefer;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>
<?php
	$mg = new MitgliedergradePrint();
	$datum = date('Y-m-d');
	$mg->Datum = $datum;
  $mg->MitgliedId = $model->MitgliederId;
  $mg->GradId = null;
  $mg->PrueferId = null; 
	$header = '<center style="color:black"><h5>'.Yii::t('app', 'New Level for ').$model->Name.', '.$model->Vorname.'</h5></center>';         
?>
				<div class="card panel panel-info" style="font-size:0.9em;">
					<div class="card card-header my-card text-white bg-info" style="height:3.5em;margin-bottom: 0px;">
					<?php //'<h5 style="padding-top:0em;margin-top:0em;">' . $model->Name . ', ' . $model->Vorname . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
              echo '<h5 style="padding-top:0em;margin-top:0em;clear: both;">'.Yii::t('app', 'Exams').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
          ?>
					<?php PopoverX::begin([ 'id' => 'mg-ag-modal',
						'header' => $header,
            'type' => PopoverX::TYPE_INFO,
            'placement' => PopoverX::ALIGN_BOTTOM,
						'size'=>'lg',					
            'headerOptions' => ['style' => 'color: white;background-color: #E8F0FD !important;'],
						'toggleButton' => ['label' => '<i class="fa fa-plus"></i>', 'class' => 'btn btn-success',],
//						'footer'=> Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default']) . Html::submitButton('Speichern', ['class'=>'btn btn-sm btn-primary'])
/*
                'class' => 'col-sm-10',
                'style' => 'float:left;',
            ],
*/					]);
					?>
					<?php $form = ActiveForm::begin([ 'action' => ['mitgliedergrade/createfast',
																													'mId' => $mg->MitgliedId,
																													'grad' => ''
																												],
																						'enableClientValidation' => true,
																						'enableAjaxValidation' => false,
																						'fieldConfig'=>['showLabels'=>true],
																						'id' => 'mg-cr-vg', 
																						'type' => ActiveForm::TYPE_HORIZONTAL,							
																						'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM,
																							'showErrors' => true,
																						]
																						]); ?>
							<div class="row" style="color:black;">																	
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							</div>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<?=  $form->field($mg, 'MitgliedId')->hiddenInput()->label(false) ; ?>
    				<?php  echo $form->field($mg, 'GradId')->dropdownList(array_merge(["" => ""], $grade_zur_auswahl),
														[ 'prompt' => Yii::t('app', 'Level'), 'id' => 'field-gid' ])->label(Yii::t('app', 'Level'));  ?>
				    <?php  echo $form->field($mg, 'PrueferId')->dropdownList( $pruefer_zur_auswahl,
													[ 'prompt' => Yii::t('app', 'Examiner'), 'id' => 'field-pid' ])->label(Yii::t('app', 'Examiner'));  ?>
							<?php  echo $form->field($mg, 'Datum')->widget(datecontrol::classname(),
							[ //'value' => date('d.m.Y'), 
								'type'=>datecontrol::FORMAT_DATE,
								'ajaxConversion'=>true,
	 							'displayFormat' => 'php:d.m.Y',
	 							'saveFormat' => 'php:Y-m-d',
	 							'autoWidget' => true,
	 							'id' => 'mgf_datu',
								'options'=>[
									'id' => 'mgf_datum',
//										'placeholder'=>'Graduierungsdatum', 
										'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true]
									]	
								])->label(Yii::t('app', 'Date')); ?>
    				<?php /*echo $form->field($mg, 'print')->checkBox(
															[ 'prompt' => 'Print', 'id' => 'field_prid' ] )*/ ?>
						<div style="text-align:right;">  <br>
						<?= Html::resetButton(Yii::t('app', 'Reset'), ['class'=>'btn btn-sm btn-default']) . "    " . Html::submitButton(Yii::t('app', 'Save'), ['class'=>'btn btn-sm btn-primary'])."</a>"
						?>
						</div>
					</div>
					</div>									
					<?php $form = ActiveForm::end(); ?>
					<?php PopoverX::end();?>
				</div> </h5>
        <div class="card-body">
 
 	<?= GridView::widget([
	        'dataProvider' => $grade,
	        'responsiveWrap' => false,
			   	'condensed'=>true,
				  'hover'=>true,
          'options' => ['id' => 'exp_row_grade',
          ], 
//					'headerRowOptions' => [ 'style' => 'font-size:0.85em',
//					],
			    'formatter' => [
			        'class' => 'yii\i18n\Formatter',
			        'nullDisplay' => '',
			    ],
//					'rowOptions' => [ 'style' => 'font-size:0.85em',
//					],
	        'columns' => [
            	[ 'class' => '\kartik\grid\ActionColumn',
            						'template' => '{print}',
												'header' => '<span style="text-align-left;">'.Yii::t('app', 'Actions').'</span>',
												'controller' => 'mitgliedergrade',
												'buttons' => [ 
													'print' => function ($url, $model) {
        										return Html::a('<span class="fa fa-print"></span>', 
																			Url::toRoute(['mitgliedergrade/print', 'id' => $model->mgID] ), [ 'data-pjax' => 0, 
                    					'target'=>"_blank",
															'title' => Yii::t('app', 'Print certificate'),
												        ]);
												    }
												],
//												'width' => '30px',
							],
							[ 'class' => '\kartik\grid\ExpandRowColumn', 
                'value' => function ($data, $model, $key, $index) { 
                        return GridView::ROW_COLLAPSED;
                    },
								'detail' => function ($data, $id, $model) use ($grade_zur_auswahl, $pruefer_zur_auswahl){
//				Yii::warning('-----$grade: '.VarDumper::dumpAsString($data));
//									$cont = Mitgliedergrade::findOne($id);
	                return Yii::$app->controller->renderPartial('/mitglieder/_grad-detail', ['model'=>$data, 'grade_zur_auswahl' => $grade_zur_auswahl,
																																							'pruefer_zur_auswahl' => $pruefer_zur_auswahl, 'p' => $data->pName,
                                                                              'g' => $data->gkdk]);
            		},
            		'enableRowClick' => true,
                'hidden' => true,
                'detailRowCssClass' => 'wtfb-light',
							],
							[ 'attribute' => 'Grad', 'value' => 'grad.gKurz', 'label' => Yii::t('app', 'Level') ],
							[ 'attribute' => 'Disziplin', 'value' => 'grad.dKurz', 'label' => Yii::t('app', 'Discipline') ],
							[ 'attribute' => 'Datum', 'value' => 'Datum', 'format' => ['date', 'php:d.m.Y'], 'label' => Yii::t('app', 'Date')  ],
//							 'PrueferId',	        
							[ 'attribute' => 'Pruefer', 'value' => 'pruefer.pName', 'label' => Yii::t('app', 'Examiner') ],
            	[ 'class' => '\kartik\grid\ActionColumn',
            						'template' => '{delete}',
												'header' => '<span style="text-align-left;">'.Yii::t('app', 'Actions').'</span>',
												'controller' => 'mitgliedergrade',
												'deleteOptions' => [
														'data-confirm' => Yii::t('app', 'Really delete this Level?'),
												],
//												'width' => '30px',
							],
				],
	    ]); ?>

			</div>		
  </div>
