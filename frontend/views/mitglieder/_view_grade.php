<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;
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
	$header = '<center><h5>Neue Graduierung für '.$model->Name.', '.$model->Vorname.'</h5></center>';         
?>
				<div class="panel panel-info" style="font-size:0.9em;height:3em;">
					<div class="panel-heading" style="height:3em;margin-bottom: 0px;">
					<?php //'<h5 style="padding-top:0em;margin-top:0em;">' . $model->Name . ', ' . $model->Vorname . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
              echo '<h5 style="padding-top:0em;margin-top:0em;clear: both;">Prüfungen&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
          ?>
					<?php Modal::begin([ 'id' => 'mg-ag-modal',
						'header' => $header,
						'size'=>'modal-md',					
						'toggleButton' => ['label' => '<i class="fa glyphicon glyphicon-plus"></i>', 'class' => 'btn btn-primary', 'style'=>"padding-top:0.1em;margin-top:0em;adjust:right;"],
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
							<div class="row">																	
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							</div>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<?=  $form->field($mg, 'MitgliedId')->hiddenInput()->label(false) ; ?>
    				<?php  echo $form->field($mg, 'GradId')->dropdownList(array_merge(["" => ""], ArrayHelper::map( Grade::find()->all(), 'gradId', 'GradName', 'DispName' )),
														[ 'prompt' => 'Grad', 'id' => 'field-gid' ])->label('Grad');  ?>
				    <?php  echo $form->field($mg, 'PrueferId')->dropdownList(ArrayHelper::map( Pruefer::find()->all(), 'prueferId', 'pName' ),
													[ 'prompt' => 'Pruefer', 'id' => 'field-pid' ])->label('Prüfer');  ?>
							<?php  echo $form->field($mg, 'Datum')->widget(DateControl::classname(),
							[ //'value' => date('d.m.Y'), 
								'type'=>DateControl::FORMAT_DATE,
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
								]); ?>
    				<?php /*echo $form->field($mg, 'print')->checkBox(
															[ 'prompt' => 'Print', 'id' => 'field_prid' ] )*/ ?>
						<div style="text-align:right;">  <br>
						<?= Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default']) . "    " . Html::submitButton('Speichern', ['class'=>'btn btn-sm btn-primary'])."</a>"
						?>
						</div>
					</div>
					</div>									
					<?php $form = ActiveForm::end(); ?>
					<?php Modal::end();?>
				</div> </h5>
			</div>		

 
 	<?= GridView::widget([
	        'dataProvider' => $grade,
	        'responsiveWrap' => false,
          'options' => ['id' => 'exp_row_grade',
          ], 
					'headerRowOptions' => [ 'style' => 'font-size:0.85em',
					],
			    'formatter' => [
			        'class' => 'yii\i18n\Formatter',
			        'nullDisplay' => '',
			    ],
					'rowOptions' => [ 'style' => 'font-size:0.85em',
					],
	        'columns' => [
            	[ 'class' => '\kartik\grid\ActionColumn',
            						'template' => '{print}',
												'header' => '<span style="text-align-left;">Aktion</span>',
												'controller' => 'mitgliedergrade',
												'buttons' => [ 
													'print' => function ($url, $model) {
        										return Html::a('<span class="glyphicon glyphicon-print"></span>', 
																			Url::toRoute(['mitgliedergrade/print', 'id' => $model->mgID] ), [ 'data-pjax' => 0, 
                    					'target'=>"_blank",
															'title' => Yii::t('app', 'Urkunde drucken'),
												        ]);
												    }
												],
//												'width' => '30px',
							],
							[ 'class' => '\kartik\grid\ExpandRowColumn', 
                'value' => function ($data, $model, $key, $index) { 
                        return GridView::ROW_COLLAPSED;
                    },
								'detail' => function ($data, $id) use ($grade_zur_auswahl, $pruefer_zur_auswahl){
									$cont = Mitgliedergrade::findOne($id);
	                return Yii::$app->controller->renderPartial('_grad-detail', ['model'=>$cont, 'grade_zur_auswahl' => $grade_zur_auswahl,
																																							'pruefer_zur_auswahl' => $pruefer_zur_auswahl,]);
            		},
            		'enableRowClick' => true,
                'hidden' => true,
							],
							[ 'attribute' => 'Grad', 'value' => 'grad.gKurz' ],
							[ 'attribute' => 'Disziplin', 'value' => 'disziplinen.DispKurz' ],
							[ 'attribute' => 'Datum', 'value' => 'Datum', 'format' => ['date', 'php:d.m.Y'] ],
//							 'PrueferId',	        
							[ 'attribute' => 'Pruefer', 'value' => 'pruefer.pName', 'label' => 'Prüfer' ],
            	[ 'class' => '\kartik\grid\ActionColumn',
            						'template' => '{delete}',
												'header' => '<span style="text-align-left;">Aktion</span>',
												'controller' => 'mitgliedergrade',
												'deleteOptions' => [
														'data-confirm' => 'Soll der Grad wirklich gelöscht werden?',
												],
//												'width' => '30px',
							],
				],
	    ]); ?>


