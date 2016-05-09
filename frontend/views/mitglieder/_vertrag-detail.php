<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
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
<div class="col-sm-9 col-md-9" >
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
				'formOptions' => [
							'action' => ['mitgliederschulen/viewfrommitglied', 'id' => $model->msID, 'tabnum' => 3 ],
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
//            	'id' => 'dv_vv_v_'.$model->msID,
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
				            	'id' => 'dv_vv_v_'.$model->msID,											
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true],
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
            ],
            
//             'AufnahmegebuehrBezahlt',

        ],
    ]);  ?>
</div>
<div class="col-sm-3 col-md-3" >
<?php if (Yii::$app->user->identity->isAdmin) { ?>
 <div class="row"style="margin-bottom: 8px;height:32px;">
 </div>
 <div class="row"style="margin-bottom: 8px">
		<?php	echo Html::a('<span class="glyphicon glyphicon-print"></span>&nbsp;Ausweis', 
															Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
													 				'SchulId' => $model->SchulId, 'txtcode' => "Ausweis", 'txtid' => 0 ] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Ausweis drucken'),
															'class'=>'btn btn-sm btn-default',
															'style' => 'width: 120px; text-align: left;',
												        ]); ?>
 </div>												        
 <div class="row"style="margin-bottom: 8px">
		<?php	echo Html::a('<span class="glyphicon glyphicon-print"></span>&nbsp;Begrüßung',  
															Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
													 				'SchulId' => $model->SchulId, 'txtcode' => "Begruessung", 'txtid' => 0 ] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Begrüßung drucken'),
															'class'=>'btn btn-sm btn-default',
															'style' => 'width: 120px; text-align: left;',
												        ]); ?>
		<?php	echo frontend\controllers\TexteController::createoutlooklink('mitglieder', $model->MitgliederId, "EmailBegruessung", $model->SchulId, 0);
											 
		?>
		
 </div>												        
 <div class="row"style="margin-bottom: 8px">
		<?php	echo Html::a('<span class="glyphicon glyphicon-print"></span>&nbsp;Aussetzen',  
															Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
													 				'SchulId' => $model->SchulId, 'txtcode' => "Aussetzen", 'txtid' => 0 ] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Aussetzen drucken'),
															'class'=>'btn btn-sm btn-default',
															'style' => 'width: 120px; text-align: left;',
												        ]); ?>
 </div>												        
 <div class="row"style="margin-bottom: 8px">
		<?php	echo Html::a('<span class="glyphicon glyphicon-print"></span>&nbsp;Kündigung',  
															Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
													 				'SchulId' => $model->SchulId, 'txtcode' => "Kuendigung", 'txtid' => 0 ] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Kündigung drucken'),
															'class'=>'btn btn-sm btn-default',
															'style' => 'width: 120px; text-align: left;',
												        ]); ?>
 </div>												        
 <div class="row"style="margin-bottom: 8px">
		<?php	echo Html::a('<span class="glyphicon glyphicon-print"></span>&nbsp;Standard-Email',  
															Url::toRoute(['/texte/print', 'datamodel' => 'mitglieder', 'dataid' => $model->MitgliederId, 
													 				'SchulId' => $model->SchulId, 'txtcode' => "Email", 'txtid' => 0] ), [
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Standard-Email drucken'),
															'class'=>'btn btn-sm btn-default',
															'style' => 'width: 120px; text-align: left;',
												        ]);
 ?>
	</div>
<?php } ?>
	<div class="row"style="margin-bottom: 8px">
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
 <div class="row"style="margin-bottom: 8px">
		<?php	
			Modal::begin([
			    'header'=>'<center>Vertrag hochladen</center>',
					'size'=>'modal-md',					
			    'toggleButton' => [
			        'label'=>'<span style="font-size:0.85em"><i class="glyphicon glyphicon-upload"></i> Vertrag hochladen</span>', 'class'=>'btn btn-default'
			    ],
			]);
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
			Modal::end();		
		?>	
	</div>
			        	
</div>
