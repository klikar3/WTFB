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
use frontend\models\Mitgliedersektionen;
use frontend\models\MitgliedersektionenSearch;
use frontend\models\Pruefer;
use frontend\models\Sektionen;
use frontend\models\SektionenSearch;
use frontend\models\Sifu;
use frontend\models\SifuSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>
<?php
	$mgs = new Mitgliedersektionen();
	$datum = date('Y-m-d');
	$mgs->vdatum = $datum;
  $mgs->mitglied_id = $model->MitgliederId;
  $mgs->sektion_id = null;
  $mgs->pruefer_id = null; 
  $mgs->vermittler_id = null; 
	$header = '<center><h5>Neue Sektion für '.$model->Name.', '.$model->Vorname.'</h5></center>';         
?>
				<div class="panel panel-info" style="font-size:0.9em;height:3em;">
					<div class="panel-heading panel-xs" style="height:3em;margin-bottom: 0px;">
					<?= '<h5 style="padding-top:0em;margin-top:0em;">' . $model->Name . ', ' . $model->Vorname . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?>
					<?php Modal::begin([ 'id' => 'mgs-modal',
						'header' => $header,
						'size'=>'modal-md',					
						'toggleButton' => ['label' => '<i class="fa glyphicon glyphicon-plus"></i>', 'class' => 'btn btn-primary', 'style'=>"padding-top:0.1em;margin-top:0em;adjust:right;"],
//						'footer'=> Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default']) . Html::submitButton('Speichern', ['class'=>'btn btn-sm btn-primary'])
					]);
					?>
					<?php $form = ActiveForm::begin([ 'action' => ['mitgliedersektionen/createfast',
																													'mId' => $mgs->mitglied_id,
																													'sektion' => ''
																												],
																						'enableClientValidation' => true,
																						'enableAjaxValidation' => false,
																						'fieldConfig'=>['showLabels'=>true],
																						'id' => 'mgs-cr-vg', 
																						'type' => ActiveForm::TYPE_HORIZONTAL,							
																						'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL,
																							'showErrors' => true,
																						]
																						]); ?>
							<div class="row">																	
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							</div>
							<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
							<?=  $form->field($mgs, 'mitglied_id')->hiddenInput()->label('') ; ?>
    				  <?php  echo $form->field($mgs, 'sektion_id')->dropdownList(ArrayHelper::map( Sektionen::find()->all(), 'sekt_id', 'kurz' ),
														[ 'prompt' => 'Sektion', 'id' => 'field-gid' ])->label('Sektion');  ?>
							<?php  echo $form->field($mgs, 'vdatum')->widget(DateControl::classname(),
							[ //'value' => date('d.m.Y'), 
								'type'=>DateControl::FORMAT_DATE,
								'ajaxConversion'=>true,
	 							'displayFormat' => 'php:d.m.Y',
	 							'saveFormat' => 'php:Y-m-d',
	 							'autoWidget' => true,
	 							'id' => 'mgfs_vdatu',
								'options'=>[
									'id' => 'mgfs_vdatum',
//										'placeholder'=>'Graduierungsdatum', 
										'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true]
									]	
								]); ?>
				    <?php  echo $form->field($mgs, 'vermittler_id')->dropdownList(ArrayHelper::map( Sifu::find()->all(), 'sId', 'SifuName' ),
													[ 'prompt' => 'Vermittler', 'id' => 'field-pid' ])->label('Vermittler');  ?>
							<?php  echo $form->field($mgs, 'pdatum')->widget(DateControl::classname(),
							[ //'value' => date('d.m.Y'), 
								'type'=>DateControl::FORMAT_DATE,
								'ajaxConversion'=>true,
	 							'displayFormat' => 'php:d.m.Y',
	 							'saveFormat' => 'php:Y-m-d',
	 							'autoWidget' => true,
	 							'id' => 'mgfs_pdatu',
								'options'=>[
									'id' => 'mgfs_pdatum',
//										'placeholder'=>'Graduierungsdatum', 
										'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true]
									]	
								]); ?>
				    <?php  echo $form->field($mgs, 'pruefer_id')->dropdownList(ArrayHelper::map( Pruefer::find()->all(), 'prueferId', 'pName' ),
													[ 'prompt' => 'Pruefer', 'id' => 'field-pid' ])->label('Prüfer');  ?>
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
	        'dataProvider' => $sektionen,
	        'responsiveWrap' => false,
					'headerRowOptions' => [ 'style' => 'font-size:0.85em',
					],
					'rowOptions' => [ 'style' => 'font-size:0.85em',
					],
			    'formatter' => [
			        'class' => 'yii\i18n\Formatter',
			        'nullDisplay' => '',
			    ],
	        'columns' => [
/*							[ 'class' => '\kartik\grid\ExpandRowColumn', 
                'value' => function ($data, $model, $key, $index) { 
                        return GridView::ROW_COLLAPSED;
                    },
								'detail' => function ($data, $id) {
									$cont = Mitgliedersektionen::findOne($id);
	                return Yii::$app->controller->renderPartial('_grad-detail', ['model'=>$cont]);
            		},
            		'enableRowClick' => true,
							],
*/							[ 'attribute' => 'Sektion', 'value' => 'sektion.kurz' ],
							[ 'attribute' => 'vdatum', 'value' => 'vdatum', 'format' => ['date', 'php:d.m.Y'] ],
							[ 'attribute' => 'Vermittler', 'value' => 'vermittler.SifuName', 'label' => 'Vermittler' ],
							[ 'attribute' => 'pdatum', 'value' => 'pdatum', 'format' => ['date', 'php:d.m.Y'] ],
//							 'PrueferId',	        
							[ 'attribute' => 'Pruefer', 'value' => 'pruefer.pName', 'label' => 'Prüfer' ],
            	[ 'class' => '\kartik\grid\ActionColumn',
            						'template' => '{delete}{update}',
												'header' => '<span style="text-align-left;">Aktion</span>',
												'controller' => 'mitgliedersektionen',
												'deleteOptions' => [
														'data-confirm' => 'Soll die Sektion wirklich gelöscht werden?',
												],
//												'width' => '30px',
							],
				],
	    ]); ?>

