<?php

use yii\helpers\ArrayHelper;
//use yii\helpers\Html;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
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
	$header = '<center style="color:black;"><h5>'.Yii::t('app', 'New Program for ').$model->Name.', '.$model->Vorname.'</h5></center>';         
?>
				<div class="card panel panel-info" style="font-size:0.9em;">
					<div class="card card-header my-card text-white bg-info panel-heading panel-xs" style="height:3.5em;margin-bottom: 0px;">
					<?php // '<h5 style="padding-top:0em;margin-top:0em;">' . $model->Name . ', ' . $model->Vorname . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' 
                echo '<h5 style="padding-top:0em;margin-top:0em;">'.Yii::t('app', 'Programs').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
          ?>
					<?php PopoverX::begin([ 'id' => 'mgs-modal',
						'header' => $header,
            'type' => PopoverX::TYPE_INFO,
            'placement' => PopoverX::ALIGN_BOTTOM,
						'size'=>'lg',					
						'toggleButton' => ['label' => '<i class="fa fa-plus"></i>', 'class' => 'btn btn-success', ],
            'headerOptions' => ['style' => 'color: white;background-color: #E8F0FD !important;'],
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
							<div class="row" style="color:black;">																	
							<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
							</div>
							<div class="col-10">
							<?=  $form->field($mgs, 'mitglied_id')->hiddenInput()->label(false) ; ?>
    				  <?php  echo $form->field($mgs, 'sektion_id')->dropdownList($sektionen_zur_auswahl,
														[ 'prompt' => Yii::t('app', 'Program'), 'id' => 'field-gid' ])->label(Yii::t('app', 'Program'));  ?>
  				    <?php /* echo $form->field($mgs, 'vermittler_id')->dropdownList(ArrayHelper::map( Sifu::find()->all(), 'sId', 'SifuName' ),
  													[ 'prompt' => 'Vermittler', 'id' => 'field-pid' ])->label('Vermittler');*/ ?>
  				    <?php  echo $form->field($mgs, 'pruefer_id')->dropdownList(ArrayHelper::map( Pruefer::find()->all(), 'prueferId', 'pName' ),
  													[ 'prompt' => Yii::t('app', 'Examiner'), 'id' => 'field-pid' ])->label(Yii::t('app', 'Examiner'));  ?>
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
								])->label( Yii::t('app', 'Date')); ?>
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
	        'dataProvider' => $sektionen,
	        'responsiveWrap' => false,
		  		'condensed'=>true,          
          'options' => ['id' => 'exp_row_sekts',
          ], 
//					'headerRowOptions' => [ 'style' => 'font-size:0.85em',
//					],
//					'rowOptions' => [ 'style' => 'font-size:0.85em',
//					],
			    'formatter' => [
			        'class' => 'yii\i18n\Formatter',
			        'nullDisplay' => '',
			    ],
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
*/
	        'columns' => [
            	[ 'class' => '\kartik\grid\ActionColumn',
            						'template' => '{print}',
												'header' => '<span style="text-align-left;">Aktion</span>',
												'controller' => 'mitgliedersektionen',
												'buttons' => [ 
													'print' => function ($url, $model) {
        										return Html::a('<span class="fa fa-print glyphicon glyphicon-print"></span>', 
																			Url::toRoute(['mitgliedersektionen/print', 'id' => $model->msekt_id] ), [ 'data-pjax' => 0, 
                    					'target'=>"_blank",
															'title' => Yii::t('app', 'Print confirmation'),
												        ]);
												    }
												],
												'width' => '30px',
							],
							[ 'class' => '\kartik\grid\ExpandRowColumn', 
                'value' => function ($data, $model, $key, $index) { 
                        return GridView::ROW_COLLAPSED;
                    },
								'detail' => function ($data, $id) use ($sektionen_zur_auswahl, $pruefer_zur_auswahl){
									$cont = Mitgliedersektionen::findOne($id);
	                return Yii::$app->controller->renderPartial('/mitglieder/_sektion-detail', ['model'=>$cont, 'sektionen_zur_auswahl' => $sektionen_zur_auswahl,
																																							'pruefer_zur_auswahl' => $pruefer_zur_auswahl,]);
            		},
            		'enableRowClick' => true,
                'hidden' => true,
                'detailRowCssClass' => 'wtfb-light',
							],
							[ 'attribute' => 'Sektion', 'value' => 'sektion.kurz', 'label' => Yii::t('app', 'Program')  ],
		//					[ 'attribute' => 'vdatum', 'value' => 'vdatum', 'format' => ['date', 'php:d.m.Y'] ],
		//					[ 'attribute' => 'Vermittler', 'value' => 'vermittler.SifuName', 'label' => 'Vermittler' ],
							[ 'attribute' => 'pdatum', 'value' => 'pdatum', 'format' => ['date', 'php:d.m.Y'], 'label' => Yii::t('app', 'Date')  ],
//							 'PrueferId',	        
							[ 'attribute' => 'Pruefer', 'value' => 'pruefer.pName', 'label' => Yii::t('app', 'Examiner') ],
            	[ 'class' => '\kartik\grid\ActionColumn',
            						'template' => '{delete}',
												'header' => '<span style="text-align-left;">'.Yii::t('app', 'Actions').'</span>',
												'controller' => 'mitgliedersektionen',
												'deleteOptions' => [
														'data-confirm' => Yii::t('app', 'Really delete this Program?'),
												],
//												'width' => '30px',
							],
				],
	    ]); ?>

			</div>		
	</div>		

