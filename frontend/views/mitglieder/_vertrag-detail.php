<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
//use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
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
use frontend\models\Texte;
use frontend\models\Vertrag;
use frontend\models\SearchVertrag;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>
<?php Pjax::begin(['id'=>'pjaxDetailView_'.$model->msID,]); ?>

<div class="col-sm-7 col-md-7"">
    <?= DetailView::widget([
    		'id' => 'dv_vv_'.$model->msID,
        'model' => $model,
				'condensed'=>true,
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}',
				'panel'=>[
					'heading'=>'&nbsp;', // Vertrag # ' . $model->msID,
					'type'=>DetailView::TYPE_INFO,
				],
        'container' => ['id'=>'id_dVOrdenPago_'.$model->msID],
				'formOptions' => [
							'action' => ['mitgliederschulen/viewfrommitglied', 'id' => $model->msID, 'tabnum' => 3, 'openv' => $model->msID ],
//              'action' => Url::current(['tabnum' => 3, '#' => 'dv_vv_'.$model->msID, 'openv' => $model->msID]),
		          'options' => ['data-pjax' => true],
		          'id' => 'frm_update_'.$model->msID,
				],
				'rowOptions' => [ 'style' => 'font-size:0.85em',
				],
				'labelColOptions' => [ 'style' => 'width:120px;'],
        'attributes' => [
            [ 'attribute' => 'SchulId',
							'id' => 'schulid_'.$model->msID,
            	'value' => $model->schul->SchulDisp,
            	'format' => 'raw',
            	'ajaxConversion' => true,
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'name' => 'schulid_w_'.$model->msID,
									'data' => ArrayHelper::map( Schulen::find()->all(), 
									'SchulId', 'SchulDisp' ),
							    'options' => [ 
				            	'id' => 'dv_vv_si_o_'.$model->msID,											
									    'pluginOptions' => [
									        'allowClear' => true,
									    ],
									],
							 ]             
            ],    
            [ 'attribute' => 'VDauerMonate',
            	'id' => 'dv_vv_a_'.$model->msID,
            ],
            [ 'attribute' => 'Von',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
            	'widgetOptions' => [
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATE,
				          'id' => 'dv_vv_vv_'.$model->msID,											
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
											'pluginOptions'=>['autoclose' => true, 'todayHighlight' => true, 'todayBtn' => true],
				            	'id' => 'dv_vv_vvp_'.$model->msID,											
									],
							]
            ],
//             'KuendigungAm',
            [ 'attribute' => 'KuendigungAm',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
            	'widgetOptions' => [
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
				            	'id' => 'dv_vv_ka_'.$model->msID,											
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
//             'Bis',
            [ 'attribute' => 'Bis',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
            	'widgetOptions' => [
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
				            	'id' => 'dv_vv_b_'.$model->msID,											
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
            [ 'attribute' => 'MonatsBeitrag',
            	'id' => 'dv_vv_mb_'.$model->msID,
            ],
//             'ZahlungsArt',
//             'Zahlungsweise',
						[ 'attribute' => 'ZahlungsArt',  
				      'id' => 'dv_vv_za_'.$model->msID,											
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
				          'id' => 'dv_vv_za_w_'.$model->msID,											
									'data' => ['Bankeinzug'=>'Bankeinzug','Bar'=>'Bar', 'Überweisung' => 'Überweisung'],
							    'options' => [
				            	'id' => 'dv_vv_za_w_p_'.$model->msID,											
									    'pluginOptions' => [
									        'allowClear' => true,
									    ],
									],
							],             
						],
						[ 'attribute' => 'Zahlungsweise',  
				      'id' => 'dv_vv_zw_'.$model->msID,											
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
				          'id' => 'dv_vv_zw_w_'.$model->msID,											
									'data' => ['monatlich'=>'monatlich','vierteljährlich'=>'vierteljährlich','halbjährlich'=>'halbjährlich','jährlich'=>'jährlich'],
							    'options' => [
				            	'id' => 'dv_vv_zw_w_p_'.$model->msID,											
									    'pluginOptions' => [
									        'allowClear' => true,
									    ],
									],
							 ]             
						],
//             'EinzugZum',
            [ 'attribute' => 'BeitragAussetzenVon',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
            	'widgetOptions' => [
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
				            	'id' => 'dv_vv_bav_'.$model->msID,											
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
//             'BeitragAussetzenVon',
//             'BeitragAussetzenBis',
            [ 'attribute' => 'BeitragAussetzenBis',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
            	'widgetOptions' => [
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
				            	'id' => 'dv_vv_bab_'.$model->msID,											
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
            [ 'attribute' =>  'BeitragAussetzenGrund',
            	'id' => 'dv_vv_bag_'.$model->msID,
            	'label' => 'Auss. Grund',
            ],
            
//             'AufnahmegebuehrBezahlt',
/*						[ 'attribute' =>  'BL',
            	'id' => 'dv_vv_bli_'.$model->msID,
            	'label' => 'BL',
            	'type' => DetailView::INPUT_CHECKBOX,
            	'ajaxConversion' => true,
						],
*/
        ],
    ]);  ?>
</div>
<div class="col-sm-3 col-md-3" >
<?php if (Yii::$app->user->identity->isAdmin) { ?>
 <div class="row" style="width:300px;margin-bottom:8px;margin-left:0px">
   <div class="col-sm-5 col-md-5 col-5" id = "wm1.$model->msID" >  
		<?php	echo Html::a('<span class="glyphicon glyphicon-print"></span>&nbsp;Ausweis', 
															Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
													 				'SchulId' => $model->SchulId, 'txtcode' => "Ausweis", 'txtid' => 0 ] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Ausweis drucken'),
															'class'=>'btn btn-sm btn-default',
															'style' => 'width: 120px; text-align: left;',
												        ]); ?>
	 </div>	
	 <div class="col-sm-5 col-md-5 col-5" id = "wm2.$model->msID" >										        
 		<?php	echo Html::mailto('<div class="btn btn-sm btn-default"	style="width: 120px; text-align: left;"><span class="glyphicon glyphicon-envelope"></span>&nbsp;Standard-Email</div>', Url::to($model->mitglieder->Email) .
									"?body=".$model->mitglieder->Anrede." ".$model->mitglieder->Vorname.",",[
											'title' => Yii::t('app', 'Standard-Email an Mitglied senden'),
							  	]);
		?>
		</div>
		<div class="col-sm-2 col-md-2 col-2" id = "wm3.$model->msID" >
		<?php 			$form2 = ActiveForm::begin([
			    'options'=>['enctype'=>'multipart/form-data', 'name' => 'formwm'.$model->msID], // important
			    'id' => 'formwm'.$model->msID,
			    'action'=>['mitgliederschulen/viewfrommitglied', 'id' => $model->msID, 'tabnum' => 3, 'openv' => $model->msID ],

			]);
			echo $form2->field($model, 'WM')->checkbox([
												'id' => 'wm'.$model->msID,
												'class' => 'left-checkbox', 
//												'value' => $model->WM, 
												'disabled' => false, 
												'style' => 'width:15px;', 
												'label' => 'WM',
												'onclick' => 'this.form.submit()', 
												'labelOptions' => ['style' => 'font-size:0.75em;']
												]);
												
/*			 Html::checkbox('wm'.$model->msID, $model->WM, [
												'id' => 'wm'.$model->msID,
												'class' => 'left-checkbox', 
												'value' => $model->WM, 
												'disabled' => false, 
												'style' => 'width:15px;', 
												'label' => 'WM',
												'onclick' => 'this.form.submit()', 
												'labelOptions' => ['style' => 'font-size:0.75em;'],
*/			/*									'ajax' => array(
			                                'type'=>'POST',
			                                'url'=>['mitgliederschulen/viewfrommitglied', 'id' => $model->msID, 'tabnum' => 3, 'openv' => $model->msID ],
			                                'data'=>"shafi"
																	)
										]);
	*/			ActiveForm::end();								
		?> 
	 </div>  
	</div>
 <div class="row" style="width:300px;margin-bottom:8px;margin-left:0px"> 
   <div class="col-sm-5 col-md-5 col-5" id = "sf1.$model->msID" >  
		<?php	echo Html::a('<span class="glyphicon glyphicon-print"></span>&nbsp;Begrüßung',  
															Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
													 				'SchulId' => $model->SchulId, 'txtcode' => "Begruessung", 'txtid' => 0 ] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Begrüßung drucken'),
															'class'=>'btn btn-sm btn-default',
															'style' => 'width: 120px; text-align: left;',
												        ]); ?>
	
	 </div>  
   <div class="col-sm-5 col-md-5 col-5" id = "sf2.$model->msID" >  
		<?php	echo frontend\controllers\TexteController::createoutlooklink('mitglieder', $model->MitgliederId, "EmailBegruessung", $model->SchulId, 0);
		?>
	 </div>  
   <div class="col-sm-2 col-md-2 col-2" id = "sf3.$model->msID" >  
		<?php //echo Html::checkbox('sf'.$model->msID, $model->SF, ['class' => 'left-checkbox', 'value' => $model->SF, 'disabled' => false, 'style' => 'width:15px;', 'label' => 'SF', 'labelOptions' => ['style' => 'font-size:0.85em;']]);
			$form3 = ActiveForm::begin([
			    'options'=>['enctype'=>'multipart/form-data'], // important
			    'id' => 'formsf'.$model->msID,
			    'action'=>['mitgliederschulen/viewfrommitglied', 'id' => $model->msID, 'tabnum' => 3, 'openv' => $model->msID ],

			]);
			echo $form3->field($model, 'SF')->checkbox([
												'id' => 'sf'.$model->msID,
												'class' => 'left-checkbox', 
//												'value' => $model->SF, 
												'disabled' => false, 
												'style' => 'width:15px;', 
												'label' => 'SF',
												'onclick' => 'this.form.submit()', 
												'labelOptions' => ['style' => 'font-size:0.75em;']
												]);
												
			ActiveForm::end();
		?> 
	 </div>  
</div>												        
 <div class="row" style="width:300px;margin-bottom:8px;margin-left:0px">
   <div class="col-sm-5 col-md-5 col-5" id = "bl1.$model->msID" >  
		<?php	echo Html::a('<span class="glyphicon glyphicon-print"></span>&nbsp;Aussetzen',  
															Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
													 				'SchulId' => $model->SchulId, 'txtcode' => "Aussetzen", 'txtid' => 0 ] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Aussetzen drucken'),
															'class'=>'btn btn-sm btn-default',
															'style' => 'width: 120px; text-align: left;',
												        ]); ?>
	 </div>  
   <div class="col-sm-5 col-md-5 col-5" id = "bl2.$model->msID" >  
		<?php	echo frontend\controllers\TexteController::createoutlooklink('mitglieder', $model->MitgliederId, "EmailAussetzen", $model->SchulId, 0);
											 
		?>
	 </div>  
   <div class="col-sm-2 col-md-2 col-2" id = "bl3.$model->msID" >  
		<?php //echo Html::checkbox('bl'.$model->msID, $model->BL, ['value' => $model->BL, 'disabled' => false, 'style' => 'width:15px;', 'label' => 'BL', 'labelOptions' => ['style' => 'font-size:0.85em;']]);
			$form4 = ActiveForm::begin([
			    'options'=>['enctype'=>'multipart/form-data', 'name' => 'formbl'.$model->msID], // important
			    'id' => 'formbl'.$model->msID,
			    'action'=>['mitgliederschulen/viewfrommitglied', 'id' => $model->msID, 'tabnum' => 3, 'openv' => $model->msID ],

			]);
					echo $form4->field($model, 'BL')->checkbox([
												'id' => 'bl'.$model->msID,
												'class' => 'left-checkbox', 
//												'value' => $model->BL, 
												'disabled' => false, 
												'style' => 'width:15px;', 
												'label' => 'BL',
												'onclick' => 'this.form.submit()', 
												'labelOptions' => ['style' => 'font-size:0.75em;']
												]);
			ActiveForm::end();

		?>
	 </div>  
 </div>												        
 <div class="row" style="width:300px;margin-bottom:8px;margin-left:0px">
   <div class="col-sm-5 col-md-5 col-5" id = "bl3.$model->msID" >  
		<?php	echo Html::a('<span class="glyphicon glyphicon-print"></span>&nbsp;Kündigung',  
															Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
													 				'SchulId' => $model->SchulId, 'txtcode' => "Kuendigung", 'txtid' => 0 ] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Kündigung drucken'),
															'class'=>'btn btn-sm btn-default',
															'style' => 'width: 120px; text-align: left;',
												        ]); ?>
	 </div>  
   <div class="col-sm-5 col-md-5 col-5" id = "bl3.$model->msID" >  
		<?php	echo frontend\controllers\TexteController::createoutlooklink('mitglieder', $model->MitgliederId, "EmailKündigung", $model->SchulId, 0);
											 
		?>
	 </div>  
   <div class="col-sm-2 col-md-2 col-2" id = "bl3.$model->msID" >  
		<?php //echo Html::checkbox('ok'.$model->msID, $model->OK, ['value' => $model->OK, 'disabled' => false, 'style' => 'width:15px;', 'label' => 'OK', 'labelOptions' => ['style' => 'font-size:0.85em;']]);
			$form5 = ActiveForm::begin([
			    'options'=>['enctype'=>'multipart/form-data', 'name' => 'formok'.$model->msID], // important
			    'id' => 'formok'.$model->msID,
			    'action'=>['mitgliederschulen/viewfrommitglied', 'id' => $model->msID, 'tabnum' => 3, 'openv' => $model->msID ],

			]);
							echo $form5->field($model, 'OK')->checkbox([
												'id' => 'ok'.$model->msID,
												'class' => 'left-checkbox', 
//												'value' => $model->OK, 
												'disabled' => false, 
												'style' => 'width:15px;', 
												'label' => 'OK',
												'onclick' => 'this.form.submit()', 
												'labelOptions' => ['style' => 'font-size:0.75em;']
												]);
			ActiveForm::end();

		?>
	 </div>  
 </div>												        
<?php } ?>
 <div class="row" style="width:250px;margin-bottom:8px;margin-left:0px">
		<?php	
			Modal::begin([
			    'header'=>'<center>Vertrag hochladen</center>',
					'size'=>'modal-md',					
			    'toggleButton' => [
			        'label'=>'<span style="font-size:0.85em"><i class="glyphicon glyphicon-upload"></i> Vertrag hoch</span>', 'class'=>'btn btn-default',
			        		'style' => 'width: 120px; text-align: left;',
			    ],
			]);
		?> <div class="modal-content" style="height:70%;"> <?php
			$form1 = ActiveForm::begin([
			    'options'=>['enctype'=>'multipart/form-data'] // important
			]);
		?>
		<p>	
		<?php	
			// A block file picker button with custom icon and label
			echo FileInput::widget([
			    'name' => 'attachment_53',
			    'pluginOptions' => [
			        'showCaption' => false,
			        'showRemove' => false,
			        'showUpload' => true,
			        'uploadLabel' => "Hochladen",
			        'msgSizeTooLarge' => "Die Datei '{name}'' ({size} KB) ist größer als die Maximalgröße von {maxSize} KB!",
			        'previewClass' => '',
			        'mainClass' => '',
			        'browseClass' => 'btn btn-default btn-sm',
			        'browseIcon' => '<i class="glyphicon glyphicon-list-alt"></i> ',
			        'browseLabel' =>  'Pdf auswählen',
			        'maxFileSize' => 1024,
			        'maxFileCount' => 1,
			        'allowedFileExtensions' => ['jpg','gif','png','pdf'],
			        'uploadUrl' => Url::toRoute(['mitgliederschulen/upload', 'id' => $model->msID, 
													 				'tabnum' => 3 ] )
			    ],
			    'options' => ['accept' => 'image/* text/*',
			    		'multiple' => false,
					]
			]);
		?>
		</p>	
		<?php	
			ActiveForm::end();
		?>	 </div> <?php
			Modal::end();		
		?>	
		<?php	if (!empty($model->vertrag)) {
				echo Html::a('<span class="glyphicon glyphicon-list-alt"></span>&nbsp;Vertrag ansehen',  
															Url::toRoute(['mitgliederschulen/vertrag', 'id' => $model->msID, 
													 				'tabnum' => 3 ] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Vertrag ansehen'),
															'class'=>'btn btn-sm btn-default',
															'style' => 'width: 120px; text-align: left;',
												        ]);
		}										        
 ?>
	</div>
<?php if (Yii::$app->user->identity->isAdmin) { ?>
	
 <div class="row" style="width:250px;margin-bottom:24px;margin-left:0px">
 		<?php	echo Html::a('<div class="btn btn-sm btn-default"	style="width: 120px; text-align: left;"><span class="glyphicon glyphicon-envelope"></span>&nbsp;WebMailer</div>', Url::to('http://swm.wingtzun.de'),[
											'title' => Yii::t('app', 'Mitglied in SWM eintragen'),
											'target' => '_blank'
							  	]);   ?>
	</div>
<?php } ?>			        	
</div>
<?php  Pjax::end(); ?>