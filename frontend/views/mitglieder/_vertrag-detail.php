<?php

use yii\helpers\ArrayHelper;
//use yii\helpers\Html;
use yii\bootstrap4\Html;
use yii\bootstrap4\BaseHtml;
use yii\bootstrap4\Modal;
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

//use frontend\assets\AppAsset;
//use frontend\assets\IbanAsset;

//AppAsset::register($this);
//IbanAsset::register($this);

/*$this->registerJS("$('#contact-form').on('beforeValidateAttribute', function (e) {
            $('#form_id').yiiActiveForm('find', '#attribute').validate = function (attribute, value, messages, deferred, $form) {
                //Custom Validation
            }
        return true;
});")
*/ 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>
<?php //Pjax::begin(['id'=>'pjaxDetailView_'.$model->msID, 'linkSelector' => 'a:not(.linksWithTarget)']); ?>
<?php $anzeigen =  (Yii::$app->user->identity->isAdmin or 
                    (Yii::$app->user->identity->username == 'eva') or 
                    (Yii::$app->user->identity->username == 'evastgt')) ? true : false; ?>
<div class="row container-fluid wtfb-light">
<div class="col-7">
    <?= DetailView::widget([
    		'id' => 'dv_vv_'.$model->msID,
        'model' => $model,
				'condensed'=>true,
        'showErrorSummary' => true,
        'fadeDelay' => 50,
				'hover'=>true,
				'mode'=> /*($formedit) ? DetailView::MODE_EDIT :*/ DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}',
				'panel'=>[
					'heading'=> Yii::t('app', 'Data'), // Vertrag # ' . $model->msID,
          'headingOptions' => [
              'class' => 'card-header text-white my-card',
          ],
					'type'=>DetailView::TYPE_INFO,
          'class' => ' text-white',
				],
        'container' => ['id'=>'id_dVOrdenPago_'.$model->msID,'class' => 'wtfb-light'],
		    'formatter' => [
		        'class' => 'yii\i18n\Formatter',
		        'nullDisplay' => '',
		    ],
				'formOptions' => [
							'action' => ['mitgliederschulen/viewfrommitglied', 'id' => $model->msID, 'tabnum' => 3, 'openv' => $model->msID ],
//              'action' => Url::current(['tabnum' => 3, '#' => 'dv_vv_'.$model->msID, 'openv' => $model->msID]),
		          'options' => ['data-pjax' => true],
		          'id' => 'frm_update_'.$model->msID,
              'enableAjaxValidation' => true,
              'enableClientValidation' => false,
				],
       'viewOptions' => [
          'style' => 'color:white!important;', 
        ],
       'updateOptions' => [
          'style' => 'color:white!important;', 
        ],
       'resetOptions' => [
          'style' => 'color:white!important;', 
        ],
       'deleteOptions' => [
          'style' => 'color:white!important;', 
        ],
       'saveOptions' => [
          'style' => 'color:white!important;', 
        ],

//				'rowOptions' => [ 'style' => 'font-size:0.85em',
//				],
				'labelColOptions' => [ 'style' => 'width:200px;'],
        'attributes' => [
            [ 'attribute' => 'SchulId',
							'id' => 'schulid_'.$model->msID,
            	'value' => $s, //$model->schul->SchulDisp,
            	'format' => 'raw',
            	'ajaxConversion' => true,
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'name' => 'schulid_w_'.$model->msID,
									'data' => $schulen,
							    'options' => [ 
				            	'id' => 'dv_vv_si_o_'.$model->msID,											
									    'pluginOptions' => [
									        'allowClear' => true,
									    ],
									],
							 ]             
            ],    
            [ 'attribute' => 'VDatum',
            	'format' => ['date', 'php:d.m.Y'],
            	'label' => Yii::t('app', 'Contract Date'),
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
            	'widgetOptions' => [
            			'class' => datecontrol::classname(),
									'type' => datecontrol::FORMAT_DATE,
				          'id' => 'dv_vd_vv_'.$model->msID,											
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
											'pluginOptions'=>['autoclose' => true, 'todayHighlight' => true, 'todayBtn' => true],
				            	'id' => 'dv_vd_vvp_'.$model->msID,											
									],
							]
            ],
            [ 'attribute' => 'Von',
              'label' => Yii::t('app', 'Entry Date'),
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
            	'widgetOptions' => [
            			'class' => datecontrol::classname(),
									'type' => datecontrol::FORMAT_DATE,
				          'id' => 'dv_vv_vv_'.$model->msID,											
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
											'pluginOptions'=>['autoclose' => true, 'todayHighlight' => true, 'todayBtn' => true],
				            	'id' => 'dv_vv_vvp_'.$model->msID,											
									],
							]
            ],
            [ 'attribute' => 'VDauerMonate',
            	'label' => Yii::t('app', 'Contract Duration'),
              'id' => 'dv_vv_a_'.$model->msID,
            ],
            [ 'attribute' => 'KFristMonate',
            	'label' => Yii::t('app', 'Notice Period'),
              'id' => 'dv_vkf_a_'.$model->msID,
            ],
            [ 'attribute' => 'VerlaengerungMonate',
            	'label' => Yii::t('app', 'C-Extension'),
              'id' => 'dv_vv_a_'.$model->msID,
            ],
            [
                'group'=>true,
                'label'=>false, //'Teil 2: Aussetzen',
                'rowOptions'=>['class'=>'wtfb-light'],
//                'groupOptions'=>['style'=>'background: lightblue;'],
                'groupOptions'=>['class' => 'wtfb-light',],
            ],                                       
            [ 'attribute' => 'MonatsBeitrag',
            	'id' => 'dv_vv_mb_'.$model->msID,
            ],
            [ 'attribute' => 'AGebuehr',
            	'id' => 'dv_vv_mb_'.$model->msID,
            ],
						[ 'attribute' => 'ZahlungsArt',  
            	'label' => Yii::t('app', 'Payment Method'),
				      'id' => 'dv_vv_za_'.$model->msID,											
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
				          'id' => 'dv_vv_za_w_'.$model->msID,											
									'data' => ['EC-Karte'=> Yii::t('app', 'EC-Card'), 'Bankeinzug'=> Yii::t('app', 'Direct Debit'), 'Bar'=>Yii::t('app', 'Cash'), 'Überweisung' => Yii::t('app', 'Transfer')],
							    'options' => [
				            	'id' => 'dv_vv_za_w_p_'.$model->msID,											
									    'pluginOptions' => [
									        'allowClear' => true,
									    ],
									],
							],             
						],
						[ 'attribute' => 'Zahlungsweise',  
            	'label' => Yii::t('app', 'Payment Type'),
				      'id' => 'dv_vv_zw_'.$model->msID,											
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
				          'id' => 'dv_vv_zw_w_'.$model->msID,											
									'data' => ['einmalig'=> Yii::t('app', 'once'), 'monatlich'=> Yii::t('app', 'monthly'), 'vierteljährlich' => Yii::t('app', 'quarterly'), 'halbjährlich' => Yii::t('app', 'half-yearly'), 'jährlich' => Yii::t('app', 'yearly')],
							    'options' => [
				            	'id' => 'dv_vv_zw_w_p_'.$model->msID,											
									    'pluginOptions' => [
									        'allowClear' => true,
									    ],
									],
							 ]             
						],
            [
                'group'=>true,
                'label'=>false, //'Teil 2: Zahlung',
                'rowOptions'=>['class'=>'wtfb-light'],
                'groupOptions'=>['class' => 'wtfb-light',]
            ],
        		  ['attribute' => 'IBAN',              
               'id' => 'dv_vv_ibn_'.$model->msID,
                ['enableAjaxValidation' => true, 'enableClientValidation' => false,  ]
              ],
        		  ['attribute' => 'BIC',['enableAjaxValidation' => true]],
             'Bank',
             'Kontoinhaber',
             [ 'attribute' => 'mandatNr',
              'label' => Yii::t('app', 'Mandate Number'),
             ], 
             [ 'attribute' => 'mandatDatum',
              'label' => Yii::t('app', 'Mandate Date'),
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
            	'widgetOptions' => [
            			'class' => datecontrol::classname(),
									'type' => datecontrol::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
				            	'id' => 'dv_vv_md_'.$model->msID,											
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
/*            [
                'group'=>true,
                'label'=>false, //'Teil 2: Aussetzen',
                'rowOptions'=>['class'=>'table-info'],
                'groupOptions'=>['style'=>'background: #d9edf7;']
            ],
            [ 'attribute' => 'AGbezahltAm',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
            	'widgetOptions' => [
            			'class' => datecontrol::classname(),
									'type' => datecontrol::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
				            	'id' => 'dv_vv_bag_'.$model->msID,											
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
*/            
            [
                'group'=>true,
                'label'=> false, //'Teil 3: Aussetzen',
                'rowOptions'=>['class'=>'wtfb-light'],
                'groupOptions'=>['class' => 'wtfb-light',]
            ],
            [ 'attribute' => 'BeitragAussetzenVon',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
            	'widgetOptions' => [
            			'class' => datecontrol::classname(),
									'type' => datecontrol::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
				            	'id' => 'dv_vv_bav_'.$model->msID,											
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
            [ 'attribute' => 'BeitragAussetzenBis',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
            	'widgetOptions' => [
            			'class' => datecontrol::classname(),
									'type' => datecontrol::FORMAT_DATE,
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
            	'label' => Yii::t('app', 'Pause Reason'),
            ],
            [
                'group'=>true,
                'label'=> false, //'Teil 3: Beendigung',
                'rowOptions'=>['class'=>'wtfb-light'],
                'groupOptions'=>['class' => 'wtfb-light',]
            ],
            [ 'attribute' => 'KuendigungAm',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
            	'label' => Yii::t('app', 'Termination'),
            	'widgetOptions' => [
            			'class' => datecontrol::classname(),
									'type' => datecontrol::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
				            	'id' => 'dv_vv_ka_'.$model->msID,											
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
            [ 'attribute' => 'Bis',
            	'format' => ['date', 'php:d.m.Y'],
            	'label' => Yii::t('app', 'Exit Date'),
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
            	'widgetOptions' => [
            			'class' => datecontrol::classname(),
									'type' => datecontrol::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
				            	'id' => 'dv_vv_b_'.$model->msID,											
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
            [ 'attribute' =>  'KuendigungGrund',
            	'id' => 'dv_vv_bag_'.$model->msID,
            	'label' => Yii::t('app', 'Termination Reason'),
            ],
            [
                'group'=>true,
                'label'=> false, //'Teil 4: Bemerkung',
                'rowOptions'=>['class'=>'wtfb-light'],
                'groupOptions'=>['class' => 'wtfb-light',]
            ],
            [ 'attribute' => 'Bemerkung',
            	'label' => Yii::t('app', 'Contract Notice'),
              'format' => 'raw',
              'type' => DetailView::INPUT_TEXTAREA,
            ],
//             'VertragId',
//             'Zahlungsweise',
            
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
<div class="col-5" >
<div clas="card border-info ">
  <div class="card-header text-white border-info my-card" style="height:3em;font-size:1.2em;">
    <?= Yii::t('app', 'Actions')  ?>
  </div>
  <div class="card-body border-info bg-light">
<?php //if (Yii::$app->user->identity->isAdmin or (Yii::$app->user->identity->username == 'eva')) { ?>
 <div class="row" style="margin-bottom:8px;margin-left:0 auto;">
   <div class="col-5 float-left" id = "wm1.$model->msID" style="!float:left;width:30em;margin-left:0px;margin-right:8px;">  
   <?php  if ($anzeigen) { 
		echo Html::a('<span class="fa fa-print"></span>&nbsp;'.Yii::t('app', 'Member Card'), 
															Url::to(['/texte/print', 'datamodel' => 'vertrag', 'dataid' => $model->MitgliederId, 
													 				'SchulId' => $model->SchulId, 'vertragId' => $model->msID, 'txtcode' => Yii::t('app', 'Ausweis'), 'txtid' => 0 ] ), [
                              'data-pjax' => 0,     
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Print Member Card'),
															'class'=>'btn btn-sm btn-default',
															'style' => 'width: 10em; text-align: left;',
												        ]);
    } ?>
	</div>	

  <div class="col-5 float-right" id = "sf3.$model->msID"  style="!float:right;width:40em;">  
 		<?php	/*echo Html::mailto('<div class="btn btn-sm btn-default" style="width: 10em; text-align: left;"><span class="fa fa-envelope"></span>&nbsp;'.Yii::t('app', 'Standard Email').'</div>', Url::to($model->mitglieder->Email) .
									"?body=".$model->mitglieder->Anrede." ".$model->mitglieder->Vorname.",",[
											'title' => Yii::t('app', 'Send Standard Email to Member'),
							  	]); */
               	echo frontend\controllers\TexteController::createoutlooklink('vertrag', $model->msID, "EmailStandard", $model->SchulId, 0);                 
		?>
		</div>
 </div>
 <div class="row" style="margin-bottom:8px;margin-left:0 auto;"> 
   		<div class="col-5 float-left" id = "sf1.$model->msID" style="!float:left;width:30em;margin-left:0px;margin-right:8px;">  
		<?php	echo Html::a('<span class="fa fa-print"></span>&nbsp;'.Yii::t('app', 'Greeting'),  
															Url::toRoute(['/texte/print', 'datamodel' => 'vertrag', 'dataid' => $model->MitgliederId, 
													 				'SchulId' => $model->SchulId, 'vertragId' => $model->msID, 'txtcode' => 'Begruessung', 'txtid' => 0 ] ), [
                              'data-pjax' => 0,     
                    					'target'=>'_blank',
															'title' => Yii::t('app', 'Print Greeting'),
															'class'=>'btn btn-sm btn-default',
															'style' => 'width: 10em; text-align: left;',
												        ]); ?>
			</div>									        
	    <div class="col-5 float-right" id = "sf2.$model->msID" style="float:right;width:40em;">
	 		<?php	echo frontend\controllers\TexteController::createoutlooklink('vertrag', $model->msID, "EmailBegruessung", $model->SchulId, 0);
		?>
   		</div>
</div>												        
 <div class="row" style="margin-bottom:8px;margin-left:0px auto">
   <div class="col-sm-5 col-md-5 col-5" id = "bl1.$model->msID" style="!float:left;width:30em;margin-left:0px;margin-right:8px;">  
		<?php	echo Html::a('<span class="fa fa-print"></span>&nbsp;'.Yii::t('app', 'Suspend'),  
															Url::toRoute(['/texte/print', 'datamodel' => 'vertrag', 'dataid' => $model->MitgliederId, 
													 				'SchulId' => $model->SchulId, 'vertragId' => $model->msID, 'txtcode' => 'Aussetzen', 'txtid' => 0 ] ), [
                              'data-pjax' => 0,     
                    					'target'=>'_blank',
															'class'=>'btn btn-sm btn-default',
															'title' => Yii::t('app', 'Print Suspend'),
															'style' => 'width: 10em; text-align: left;',
												        ]); ?>
	 </div>
   <div class="col-5" id = "bl2.$model->msID" style="!float:right;width:40em;margin-left:0px;margin-right:8px;">  
		<?php	echo frontend\controllers\TexteController::createoutlooklink('vertrag', $model->msID, "EmailAussetzen", $model->SchulId, 0);
											 
		?>
	 </div>  
 </div>												        
 <div class="row" style="margin-bottom:8px;margin-left:0 auto;">
   <div class="col-5" id = "bl3.$model->msID" style="!float:left;width:30em;margin-left:0px;margin-right:8px;">  
		<?php	echo Html::a('<span class="fa fa-print"></span>&nbsp;'.Yii::t('app', 'Termination'),  
															Url::toRoute(['/texte/print', 'datamodel' => 'vertrag', 'dataid' => $model->MitgliederId, 
													 				'SchulId' => $model->SchulId, 'vertragId' => $model->msID, 'txtcode' => "Kuendigung", 'txtid' => 0 ] ), [
                              'data-pjax' => 0,     
                    					'target'=>'_blank',
															'class'=>'btn btn-sm btn-default',
															'title' => Yii::t('app', 'Print Termination'),
															'style' => 'width: 10em; text-align: left;',
												        ]); ?>
		</div>										        
   <div class="col-sm-5 col-md-5 col-5" id = "bl4.$model->msID" style="!float:left;width:40em;margin-left:0px;margin-right:8px;">  
		<?php	echo frontend\controllers\TexteController::createoutlooklink('vertrag', $model->msID, "EmailKuendigung", $model->SchulId, 0);
											 
		?>
	 </div>  
 </div>	
 <div class="row" style="margin-bottom:8px;margin-left:0 auto;">
   <div class="col-5" id = "v1.$model->msID" style="!float:left;width:30em;margin-left:0px;margin-right:8px;">  
		<?php	
			Modal::begin([
			    'title'=>'<center>'.Yii::t('app', 'Upload Contract').'</center>',
					'size'=>'modal-md',
			    'toggleButton' => [
			        'label'=>'<span style="font-size:1em"><i class="fa fa-upload"></i> '.Yii::t('app', 'Up Contract').'</span>', 
              'class'=>'btn btn-sm btn-default',
			        'style' => 'width: 10em; text-align: left;padding-top:2px',
              'title' => Yii::t('app', 'Upload Contract-Pdf into WT-Data'), 
			    ],
          'clientOptions' => [
            'backdrop' => 'static',					
          ]
			]);
		?> <div class="modal-content" style="height:70%;"> <?php
			$form1 = ActiveForm::begin([
			    'options'=>[//'enctype'=>'multipart/form-data', 
                      'action' => Url::toRoute(['/mitgliederschulen/upload', 'id' => $model->msID, 
													 				'tabnum' => 3]), // important
                      'target' => '_blank',
          ]           
			]);
		?>
		<p>	
		<?php	
			// A block file picker button with custom icon and label
//      Yii::$app->params['uploadUrl'] = Url::toRoute(['/mitgliederschulen/upload', 'id' => $model->msID, 
//													 				'tabnum' => 3 ] );
			echo FileInput::widget([
			    'name' => 'attachment_53'.$model->msID,
          'id' => 'attachment_53'.$model->msID,
			    'pluginOptions' => [
			        'showCaption' => true, //'action' => 'get',
			        'showRemove' => true,
			        'showUpload' => true,
              'uploadAsync' => true,
			        'uploadLabel' =>  Yii::t('app', 'Upload'),
			        'browseLabel' =>  Yii::t('app', 'Select Pdf'),
			        'msgSizeTooLarge' => Yii::t('app', "The File '{name}'' ({size} KB) is bigger than the maximum allowed Size of {maxSize} KB!"),
//			        'previewClass' => '',
//			        'mainClass' => '',
			        'browseClass' => 'btn btn-default btn-sm',
			        'browseIcon' => '<i class="fa fa-file-alt"></i> ',
			        'maxFileSize' => 1024,
			        'maxFileCount' => 1,
			        'allowedFileExtensions' => ['jpg','gif','png','pdf'],
              'uploadPath' => 'D:'. DIRECTORY_SEPARATOR .'wamp64'. DIRECTORY_SEPARATOR .'tmp',
              'uploadUrl' => Url::toRoute(['/mitgliederschulen/upload', 'id' => $model->msID, 
													 				'tabnum' => 3]),//\Yii::$app->request->BaseUrl.'/index.php?r=mitgliederschulen/upload',
              'uploadExtraData' => [
                  'id' => 'attachment_53'.$model->msID,
                  'tabnum' => 3,
                  'modelId' => $model->msID
              ]
//			        'uploadUrl' => Url::to(['/mitgliederschulen/upload', 'id' => $model->msID, 
//													 				'tabnum' => 3 ] ),
			    ],
			    'options' => ['accept' => 'image/jpeg,application/pdf',
			    		'multiple' => false, 'id' => 'attachment_53'.$model->msID,
              'title' => Yii::t('app', 'Upload Contract-Pdf into WT-Data'),
					],
//          'pluginEvents' => [
//              'fileuploaded' => 'this.form.submit()',
//          ],
			]);
//    echo Html::submitButton('Eintragen', ['class' => 'btn btn-sm btn-default']);  
		?>
		</p>	
		<?php	
			ActiveForm::end();
		?>	 </div> <?php
			Modal::end();		
		?>
	 </div>		
   <div class="col-5" id = "v2.$model->msID" style="!float:left;width:40em;margin-left:0px;margin-right:8px;">  
		<?php	if (!empty($model->VertragId)) {
				echo Html::a('<span class="fa fa-file-alt"></span>&nbsp;'.Yii::t('app', 'View Contract'),  
															Url::to(['mitgliederschulen/vertrag', 'id' => $model->msID, 
													 				'tabnum' => 3 ] ), [
															'title' => Yii::t('app', 'View Contract'),
                              'data-pjax' => 0,     
                    					'target' => '_blank',
															'class'=>'btn btn-sm btn-default',
															'style' => 'width: 10em; text-align: left;padding-top:2px',
												        ]);
		}										        
 ?>
	 </div>  
</div>
 <div class="row" style="margin-bottom:8px;margin-left:width:0px auto;">
   <div class="col-5" id = "v1.$model->msID" style="!float:left;width:40em;margin-left:0px;margin-right:8px;">  
    <?php  if ($anzeigen) { 
        if (($model->schul->swmMitgliederListe != 0 ) && ($model->schul->swmMitgliederForm != 0 )) {
            echo Html::beginForm('https://nl.wtfb.de/nl.php', 'post', ['enctype' => 'multipart/form-data', 'target' => '_blank', 'id' => 'formswm'.$model->msID]);
            echo Html::hiddenInput('MailingListId', $model->schul->swmMitgliederListe);
            echo Html::hiddenInput('FormId', $model->schul->swmMitgliederForm);
            echo Html::hiddenInput('FormEncoding', 'utf-8');
            echo Html::hiddenInput('u_EMail', $model->mitglieder->Email,['id' => "u_EMail"]);
            echo Html::hiddenInput('u_Gender', ($model->mitglieder->Geschlecht == Yii::t('app', 'male')) ? 'm' : 'w',['id' => "u_Gender_f"]);
            echo Html::hiddenInput('u_FirstName', $model->mitglieder->Vorname,['id' => "u_FirstName"]);
            echo Html::hiddenInput('u_LastName', $model->mitglieder->Name,['id' => "u_LastName"]);
            echo Html::hiddenInput('u_Birthday', $model->mitglieder->GeburtsDatum,['id' => "u_Birthday"]);
            echo Html::hiddenInput('u_Salutation', (strpos($model->mitglieder->Anrede, 'Herr') !== false ) ? 'Lieber' : ((strpos($model->mitglieder->Anrede, 'Frau') !== false ) ? 'Liebe' : 'Liebe Familie' ),['id' => "u_Salutation"]);
            echo Html::hiddenInput('Action', 'subscribe');
            echo Html::submitButton('<span class="fa fa-file-alt"></span>&nbsp;'.Yii::t('app', 'Enter into NL').'&nbsp;&nbsp;', ['class' => 'btn btn-sm btn-default', 'title' => 'Enter into Newsletter for Members', 'style' => 'width: 10em; text-align: left;']);
            echo Html::endForm(); 
					}				
		 } ?>                 
	 </div>
	
   <div class="col-sm-2 col-md-2 col-2" id = "bl4.$model->msID" style="!float:left;width:40em;margin-left:0px;margin-right:8px;">  
		<?php if ($anzeigen /*Yii::$app->user->identity->isAdmin*/) { 
                echo frontend\controllers\TexteController::createoutlooklink('vertrag', $model->msID, "EmailWTOnline", $model->SchulId, 0);
			  }								 
		?>
   </div>						  	
	</div>

 <div class="row" style="margin-bottom:8px;margin-left:width:0px auto;">
   <div class="col-5" id = "v1.$model->msID" style="!float:left;width:30em;margin-left:0px;margin-right:8px;">  
    <?php  if ($anzeigen) { 
        if (($model->schul->swmInteressentenListe != 0 ) && ($model->schul->swmInteressentenForm != 0 )) {
            echo Html::beginForm('https://nl.wtfb.de/nl.php', 'post', ['enctype' => 'multipart/form-data', 'target' => '_blank', 'id' => 'formswm'.$model->msID]);
            echo Html::hiddenInput('MailingListId', $model->schul->swmInteressentenListe);
            echo Html::hiddenInput('FormId', $model->schul->swmInteressentenForm);
            echo Html::hiddenInput('FormEncoding', 'utf-8');
            echo Html::hiddenInput('u_EMail', $model->mitglieder->Email,['id' => "u_EMail"]);
            echo Html::hiddenInput('u_Gender', ($model->mitglieder->Geschlecht == Yii::t('app', 'male')) ? 'm' : 'w',['id' => "u_Gender_f"]);
            echo Html::hiddenInput('u_FirstName', $model->mitglieder->Vorname,['id' => "u_FirstName"]);
            echo Html::hiddenInput('u_LastName', $model->mitglieder->Name,['id' => "u_LastName"]);
            echo Html::hiddenInput('u_Birthday', $model->mitglieder->GeburtsDatum,['id' => "u_Birthday"]);
            echo Html::hiddenInput('u_Salutation', (strpos($model->mitglieder->Anrede, 'Herr') !== false ) ? 'Lieber' : ((strpos($model->mitglieder->Anrede, 'Frau') !== false ) ? 'Liebe' : 'Liebe Familie' ),['id' => "u_Salutation"]);
            echo Html::hiddenInput('Action', 'unsubscribe');
            echo Html::submitButton('<span class="fa fa-file-alt"></span>&nbsp;'.Yii::t('app', 'Exit NL-Int.'), ['class' => 'btn btn-sm btn-default', 'title' => 'Take out of Newsletter for Interested Persons', 'style' => 'width: 10em; text-align: left;']);
            echo Html::endForm(); 
					}				
		 } ?>                 
	 </div>
	
   <div class="col-sm-2 col-md-2 col-2" id = "bl2.$model->msID" style="!float:left;width:40em;margin-left:0px;margin-right:8px;">  
   	<?php	echo Html::a('<div class="btn btn-sm btn-primary"	style="width: 10em; text-align: left;"><span class="fa fa-envelope"></span>&nbsp;'.Yii::t('app', 'IBAN-Calculator').'</div>', Url::to('https://www.iban-rechner.de'),[
											'title' => Yii::t('app', 'Calculate / Verify IBAN'),
											'target' => '_blank'
							  	]);   ?>
   </div>						  	
	</div>
 <div class="row" style="margin-bottom:8px;margin-left:0 auto;">
   <div class="col-sm-6 col-md-6 col-6" id = "bl3.$model->msID" style="!float:left;width:40em;margin-left:0px;margin-right:8px;">  
<br>
<table class="table table-condensed">
 <tr>  
		<?php if ($anzeigen) {//echo Html::checkbox('sf'.$model->msID, $model->SF, ['class' => 'left-checkbox', 'value' => $model->SF, 'disabled' => false, 'style' => 'width:15px;', 'label' => 'SF', 'labelOptions' => ['style' => 'font-size:0.85em;']]);
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
												'label' => 'Bank',
												'labelOptions' => ['style' => 'font-size:0.75em;width:5em'],
												'onclick' => 'this.form.submit()', 
												]);
												
			ActiveForm::end();   }
		?> 
  
 </tr>
  <tr>		<?php 
			$form4 = ActiveForm::begin([
        			    'options'=>['enctype'=>'multipart/form-data', 'name' => 'formbl'.$model->msID], // important
        			    'id' => 'formwe'.$model->msID,
        			    'action'=>['mitgliederschulen/viewfrommitglied', 'id' => $model->msID, 'tabnum' => 3, 'openv' => $model->msID ],
        
        			]);
					echo $form4->field($model, 'WtoEmail')->checkbox([
												'id' => 'bvwe'.$model->msID,
												'class' => 'left-checkbox', 
												'disabled' => false, 
												'style' => 'width:15px;', 
												'label' => 'WTO-Email',
												'onclick' => 'this.form.submit()', 
												'labelOptions' => ['style' => 'font-size:0.75em;width:3em', 'class' => 'form-control-sm']
												]);
			ActiveForm::end();

		?>
  
 </tr>
 <tr>		<?php 
			$form4 = ActiveForm::begin([
        			    'options'=>['enctype'=>'multipart/form-data', 'name' => 'formbl'.$model->msID], // important
        			    'id' => 'formblwf'.$model->msID,
        			    'action'=>['mitgliederschulen/viewfrommitglied', 'id' => $model->msID, 'tabnum' => 3, 'openv' => $model->msID ],
        
        			]);
					echo $form4->field($model, 'WtoFreis')->checkbox([
												'id' => 'bvwf'.$model->msID,
												'class' => 'left-checkbox', 
												'disabled' => false, 
												'style' => 'width:15px;', 
												'label' => 'WTO-Freisch.',
												'onclick' => 'this.form.submit()', 
												'labelOptions' => ['style' => 'font-size:0.75em;width:3em', 'class' => 'form-control-sm']
												]);
			ActiveForm::end();

		?>
  
 </tr>

 <tr>  
		<?php  if ($anzeigen) {//echo Html::checkbox('ok'.$model->msID, $model->OK, ['value' => $model->OK, 'disabled' => false, 'style' => 'width:15px;', 'label' => 'OK', 'labelOptions' => ['style' => 'font-size:0.85em;']]);
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
										'label' => Yii::t('app', 'Member Card'),
										'onclick' => 'this.form.submit()', 
										'labelOptions' => ['style' => 'font-size:0.75em;width:10em']
										]);
			ActiveForm::end();  }

		?>
  
 </tr>
</table>
    </div>
  </div>
</div>
</div>
</div>
</div>		        	
<?php // Pjax::end(); ?>