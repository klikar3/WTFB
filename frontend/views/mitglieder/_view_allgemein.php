<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;
//use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\detail\DetailView;
use kartik\popover\PopoverX;

use frontend\models\Anrede;
use frontend\models\Funktion;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\InteressentVorgaben;
use frontend\models\Mitglieder;
use frontend\models\Mitgliedergrade;
use frontend\models\Pruefer;
use frontend\models\Schulen;
use frontend\models\Sifu;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

$newnr = Mitglieder::find()->max('MitgliedsNr') + 1;
?>
<div class="row">
<div class="col-md-6">   
       <?= DetailView::widget([
    		'id' => 'dv_va',
        'model' => $model,
				'condensed'=>true,
//				'container' => ['style' => 'font-size:0.9em'],
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}',
				'panel'=>[
					'heading'=>'Person', //$model->Name . ', ' . $model->Vorname,
					'headingOptions' => ['style' => 'font-size:1em'],
					'type'=>DetailView::TYPE_INFO,					
				],
				'formOptions' => [
							'action' => ['mitglieder/view', 'id' => $model->MitgliederId, 'tabnum' => 1/*, 'style' => 'font-size:1em',*/],
				],
		    'formatter' => [
	        'class' => 'yii\i18n\Formatter',
	        'nullDisplay' => '',
		    ],
				'rowOptions' => [ 'style' => 'font-size:0.85em',
				],
        'valueColOptions'=>['style'=>'width:30%'], 
        'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
        'attributes' => [
           ['attribute' => 'MitgliedsNr',
          	'format' => 'raw',
//            	'class'=>'col-sm-6 table_class',
          	'type' => DetailView::INPUT_SELECT2,
          	'value' => $model->MitgliedsNr,
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'widgetOptions' => [
								'data' => [$model->MitgliedsNr=>$model->MitgliedsNr, 0=>0, $newnr => $newnr ], 
						 ],
           ],
            [ 'attribute' => 'Schulort',
	            'format' => 'raw',
	            'type' => DetailView::INPUT_SELECT2,
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
	            'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( schulen::find()->distinct()->orderBy('SchulId')->all(), 
									'Schulname', 'Schulname' )),
							]
            ],
            [ 'attribute' => 'Anrede',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( Anrede::find()->orderBy('anrId')->all(), 'inhalt', 'inhalt' )),
							 ]             
            ],
            [ 'attribute' => 'Name',
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            ], 
            [ 'attribute' => 'Vorname',
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            ], 
            [ 'attribute' => 'Geschlecht',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ['männlich'=>'männlich','weiblich'=>'weiblich']),
							]
            ],
            [ 'attribute' => 'GeburtsDatum',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            	'widgetOptions' => [
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
            [ 'attribute' => 'Strasse',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            ],
            [ 'attribute' => 'PLZ',
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            ],
            [ 'attribute' => 'Wohnort',
               'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ],
            [ 'attribute' => 'Nationalitaet',
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            ],
          [ 'attribute' => 'Beruf',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          ],
          [ 'attribute' => 'Telefon1',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          ],
          [ 'attribute' => 'HandyNr',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          ],
          [ 'attribute' => 'Email',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          ],
          [ 'attribute' => 'Funktion',
          	'format' => 'raw',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_SELECT2,
          	'widgetOptions' => [
								'data' => array_merge(array_merge(["" => ""], ArrayHelper::map( funktion::find()->distinct()->orderBy('FunkId')->all(), 
								'inhalt', 'inhalt' )),['style'=>'']),
						 ]             
          ],
          [ 'attribute' => 'Sifu',
          	'format' => 'raw',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_SELECT2,
          	'widgetOptions' => [
								'data' => array_merge(["" => ""], ArrayHelper::map( Sifu::find()->orderBy('sId')->all(), 'SifuName', 'SifuName' )),
						 ]             
          ],
          [ 'attribute' => 'ErzBerechtigter',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          ],
    ],]); ?>
  
</div>
<div class="col-md-6">
       <?= DetailView::widget([
    		'id' => 'dv_vb',
        'model' => $model,
				'condensed'=>true,
//				'container' => ['style' => 'font-size:0.9em'],
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}',
				'panel'=>[
					'heading'=> 'Kontakt', //$model->Name . ', ' . $model->Vorname,
					'headingOptions' => ['style' => 'font-size:1em'],
					'type'=>DetailView::TYPE_INFO,					
				],
				'formOptions' => [
							'action' => ['mitglieder/view', 'id' => $model->MitgliederId, 'tabnum' => 1/*, 'style' => 'font-size:1em',*/],
				],
		    'formatter' => [
	        'class' => 'yii\i18n\Formatter',
	        'nullDisplay' => '',
		    ],
				'rowOptions' => [ 'style' => 'font-size:0.85em',
				],
        'valueColOptions'=>['style'=>'width:30%'], 
        'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
        'attributes' => [
          [ 'attribute' => 'KontaktAm',
          	'format' => ['date', 'php:d.m.Y'],
            'valueColOptions'=>['style'=>'width:30%;'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_WIDGET,
          	'ajaxConversion' => true,
//        			'nullDisplay' => '<span class="glyphicon glyphicon-question-sign"></span>',
          	'widgetOptions' => [
          			'class' => DateControl::classname(),
								'type' => DateControl::FORMAT_DATE,
						    'displayFormat' => 'php:d.m.Y',
						    'saveFormat' => 'php:Y-m-d',
						    'options' => [
										'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
								],
						],
          ],
          [ 'attribute' => 'KontaktArt',
          	'format' => 'raw',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_SELECT2,
          	'widgetOptions' => [
								'data' => array_merge(["" => ""], ArrayHelper::map( InteressentVorgaben::find()->andWhere(['code' => "KontaktArt"])->orderBy('sort')->all(), 'wert', 'wert' )),
						 ],             
          ],
          [ 'attribute' => 'Woher',
          	'format' => 'raw',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_SELECT2,
          	'widgetOptions' => [
								'data' => array_merge(["" => ""], ArrayHelper::map( InteressentVorgaben::find()->andWhere(['code' => "Woher"])->orderBy('sort')->all(), 'wert', 'wert' )),
						 ],             
          ],   
          [ 'attribute' => 'Disziplin',
          	'format' => 'raw',
          'valueColOptions'=>['style'=>'width:30%'], 
          'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_SELECT2,
          	'widgetOptions' => [
								'data' => array_merge(["" => ""], ArrayHelper::map( Disziplinen::find()->orderBy('sort')->all(), 'DispName', 'DispName' )),
						 ],             
          ],
          [ 'attribute' => 'EinladungIAzum',
          	'format' => ['date', 'php:d.m.Y'],
          'valueColOptions'=>['style'=>'width:30%'], 
          'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_WIDGET,
          	'ajaxConversion' => true,
   					'label' => 'Info-Abend am',
         	  'widgetOptions' => [
          			'class' => DateControl::classname(),
								'type' => DateControl::FORMAT_DATE,
						    'displayFormat' => 'php:d.m.Y',
						    'saveFormat' => 'php:Y-m-d',
                'options' => [
										'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
  							    ],
						],
          ],
          [ 'attribute'=>'WarZumIAda', 
          'valueColOptions'=>['style'=>'width:30%'], 
          'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
					  'type'=>DetailView::INPUT_CHECKBOX_X,    
						'value' => $model->showTriState($model->WarZumIAda),
  					'autoLabel' => true,
  					'label' => 'War zum IA da',
						'widgetOptions' => [
									'id' => 'wziad',				
									'pluginOptions'=>[  
										'threeState' => false, 
									],
						],
					],
          [ 'attribute' => 'ProbetrainingAm',
          	'format' => ['date', 'php:d.m.Y'],
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_WIDGET,
            'label' => 'Probetraining am',
          	'ajaxConversion' => true,
          	'widgetOptions' => [
          			'class' => DateControl::classname(),
								'type' => DateControl::FORMAT_DATE,
						    'displayFormat' => 'php:d.m.Y',
						    'saveFormat' => 'php:Y-m-d',
						    'options' => [
										'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
								],
						],
          ],
           ['attribute'=>'PTwarDa','type'=>DetailView::INPUT_CHECKBOX_X, //'format' => 'boolean',    
						'value' => $model->showTriState($model->PTwarDa),
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
							'widgetOptions' => [
									'id' => 'ptwd',				
									'pluginOptions'=>[  
										'threeState' => false, 
									],
						],
					 ],                         
           ['attribute'=>'VertragAbgeschlossen','type'=>DetailView::INPUT_CHECKBOX_X, //'format' => 'boolean',    
						'value' => $model->showTriState($model->VertragAbgeschlossen),
            'label'	=> 'Vertrag',			
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
						'widgetOptions' => [				
									'id' => 'vack',
									'pluginOptions'=>[  
										'threeState' => false, 
									],
						],
					 ],
           ['attribute'=>'VertragMit','type'=>DetailView::INPUT_CHECKBOX_X, //'format' => 'boolean',    
						'value' => $model->showTriState($model->VertragMit),
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
						'widgetOptions' => [				
									'id' => 'vmck',				
									'pluginOptions'=>[  
										'threeState' => false, 
									],
						],
					 ],
/*           ['attribute'=>'Bemerkung2',
            'label' => 'Bemerkung',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
*/           ['attribute'=>'GutscheinVon',
            'label' => 'Gutschein von',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
            [
                'group'=>true,
                'label'=>false, //'Teil 2: Aussetzen',
                'rowOptions'=>['class'=>'table-info'],
//                'groupOptions'=>['style'=>'background: lightblue;'],
                'groupOptions'=>['style'=>'background: #d9edf7;height:2em;'],
            ],
            [ 'attribute' => 'Bemerkung1',
            	'label' => 'Bemerkung',
              'format' => 'raw',
              'type' => DetailView::INPUT_TEXTAREA,
            ],

        ],
    ]) ?>
    <?php 
          echo Html::beginForm('https://nl.wtfb.de/nl.php', 'post', ['enctype' => 'multipart/form-data', 'target' => '_blank', 'id' => 'formswm'.$model->MitgliederId]);
          echo Html::hiddenInput('MailingListId', 1);
          echo Html::hiddenInput('FormId', 2);
          echo Html::hiddenInput('FormEncoding', 'utf-8');
//          echo Html::hiddenInput('HTMLForm', 'subform');
          echo Html::hiddenInput('u_EMail', $model->Email,['id' => "u_EMail"]);
          echo Html::hiddenInput('u_Gender', ($model->Geschlecht == 'männlich') ? 'm' : 'w',['id' => "u_Gender_f"]);
          echo Html::hiddenInput('u_FirstName', $model->Vorname,['id' => "u_FirstName"]);
          echo Html::hiddenInput('u_LastName', $model->Name,['id' => "u_LastName"]);
          echo Html::hiddenInput('u_Salutation', (strpos($model->Anrede, 'Herr') !== false ) ? 'Hallo Herr' : ((strpos($model->Anrede, 'Frau') !== false ) ? 'Hallo Frau' : 'Hallo Familie' ),['id' => "u_Salutation"]);
          echo Html::hiddenInput('Action', 'subscribe');
          echo Html::submitButton('In NL-Interessent eintragen', ['class' => 'btn btn-sm btn-default']);
          echo Html::endForm(); 
    ?>

</div>
</div>

<?php if (1==0) {?>

<div class="col-sm-12 hidden-xs"> 
    <?= DetailView::widget([
    		'id' => 'dv_va',
        'model' => $model,
				'condensed'=>true,
//				'container' => ['style' => 'font-size:0.9em'],
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}',
				'panel'=>[
					'heading'=>$model->Name . ', ' . $model->Vorname,
					'headingOptions' => ['style' => 'font-size:1em'],
					'type'=>DetailView::TYPE_INFO,					
				],
				'formOptions' => [
							'action' => ['mitglieder/view', 'id' => $model->MitgliederId, 'tabnum' => 1/*, 'style' => 'font-size:1em',*/],
				],
		    'formatter' => [
	        'class' => 'yii\i18n\Formatter',
	        'nullDisplay' => '',
		    ],
				'rowOptions' => [ 'style' => 'font-size:0.85em',
				],
        'valueColOptions'=>['style'=>'width:30%'], 
        'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
        'attributes' => [
            [     
              'columns' => [ 
                 ['attribute' => 'MitgliedsNr',
                	'format' => 'raw',
    //            	'class'=>'col-sm-6 table_class',
                	'type' => DetailView::INPUT_SELECT2,
                	'value' => $model->MitgliedsNr,
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                	'widgetOptions' => [
    									'data' => [$model->MitgliedsNr=>$model->MitgliedsNr, 0=>0, $newnr => $newnr ], 
    							 ],
                ],
                ['group'=>true,
                 'valueColOptions'=>['style'=>'width:2%;'],
                 'groupOptions'=>['style'=>'background: #d9edf7;'],
                ],
                [ 'attribute' => 'KontaktAm',
                	'format' => ['date', 'php:d.m.Y'],
                  'valueColOptions'=>['style'=>'width:30%;'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                	'type' => DetailView::INPUT_WIDGET,
                	'ajaxConversion' => true,
    //        			'nullDisplay' => '<span class="glyphicon glyphicon-question-sign"></span>',
                	'widgetOptions' => [
                			'class' => DateControl::classname(),
    									'type' => DateControl::FORMAT_DATE,
    							    'displayFormat' => 'php:d.m.Y',
    							    'saveFormat' => 'php:Y-m-d',
    							    'options' => [
    											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
    									],
    							],
                ],
             ],
          ],   
          [     
            'columns' => [ 
                [ 'attribute' => 'Schulort',
    	            'format' => 'raw',
    	            'type' => DetailView::INPUT_SELECT2,
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
    	            'widgetOptions' => [
    									'data' => array_merge(["" => ""], ArrayHelper::map( schulen::find()->distinct()->orderBy('SchulId')->all(), 
    									'Schulname', 'Schulname' )),
    							]
                ],
                ['group'=>true,
                 'valueColOptions'=>['style'=>'width:5%;'],
                 'groupOptions'=>['style'=>'background: #d9edf7;'],
                ],
                [ 'attribute' => 'KontaktArt',
                	'format' => 'raw',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                	'type' => DetailView::INPUT_SELECT2,
                	'widgetOptions' => [
    									'data' => array_merge(["" => ""], ArrayHelper::map( InteressentVorgaben::find()->andWhere(['code' => "KontaktArt"])->orderBy('sort')->all(), 'wert', 'wert' )),
    							 ],             
                ],
            ],
           ], 
            [     
              'columns' => [ 
                  [ 'attribute' => 'Anrede',
                  	'format' => 'raw',
                  	'type' => DetailView::INPUT_SELECT2,
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                  	'widgetOptions' => [
      									'data' => array_merge(["" => ""], ArrayHelper::map( Anrede::find()->orderBy('anrId')->all(), 'inhalt', 'inhalt' )),
      							 ]             
                  ],
                  ['group'=>true,
                   'valueColOptions'=>['style'=>'width:5%;'],
                   'groupOptions'=>['style'=>'background: #d9edf7;'],
                  ],
      	          [ 'attribute' => 'Disziplin',
                  	'format' => 'raw',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                  	'type' => DetailView::INPUT_SELECT2,
                  	'widgetOptions' => [
      									'data' => array_merge(["" => ""], ArrayHelper::map( Disziplinen::find()->orderBy('sort')->all(), 'DispName', 'DispName' )),
      							 ],             
                  ],
              ],
            ],  
            [     
               'columns' => [ 
                  [ 'attribute' => 'Name',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                  ], 
                  ['group'=>true,
                   'valueColOptions'=>['style'=>'width:5%;'],
                   'groupOptions'=>['style'=>'background: #d9edf7;'],
                  ],
                  [ 'attribute' => 'EinladungIAzum',
                  	'format' => ['date', 'php:d.m.Y'],
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                  	'type' => DetailView::INPUT_WIDGET,
                  	'ajaxConversion' => true,
           					'label' => 'Info-Abend am',
                 	  'widgetOptions' => [
                  			'class' => DateControl::classname(),
      									'type' => DateControl::FORMAT_DATE,
      							    'displayFormat' => 'php:d.m.Y',
      							    'saveFormat' => 'php:Y-m-d',
                        'options' => [
      											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
          							    ],
      							],
                  ],
               ],
            ],   
            [     
                'columns' => [ 
                  [ 'attribute' => 'Vorname',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                  ], 
                  ['group'=>true,
                   'valueColOptions'=>['style'=>'width:5%;'],
                   'groupOptions'=>['style'=>'background: #d9edf7;'],
                  ],
                  [ 'attribute'=>'WarZumIAda', 
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
       						  'type'=>DetailView::INPUT_CHECKBOX_X,    
      							'value' => $model->showTriState($model->WarZumIAda),
          					'autoLabel' => true,
          					'label' => 'War zum IA da',
      							'widgetOptions' => [
      										'id' => 'wziad',				
      										'pluginOptions'=>[  
      											'threeState' => false, 
      										],
      							],
      						],
               ],
            ],   
            [     
              'columns' => [ 
                [ 'attribute' => 'Geschlecht',
                	'format' => 'raw',
                	'type' => DetailView::INPUT_SELECT2,
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                	'widgetOptions' => [
    									'data' => array_merge(["" => ""], ['männlich'=>'männlich','weiblich'=>'weiblich']),
    							]
                ],
                ['group'=>true,
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                 'groupOptions'=>['style'=>'background: #d9edf7;'],
                ],
                [ 'attribute' => 'ProbetrainingAm',
                	'format' => ['date', 'php:d.m.Y'],
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                	'type' => DetailView::INPUT_WIDGET,
                  'label' => 'Probetr. am',
                	'ajaxConversion' => true,
                	'widgetOptions' => [
                			'class' => DateControl::classname(),
    									'type' => DateControl::FORMAT_DATE,
    							    'displayFormat' => 'php:d.m.Y',
    							    'saveFormat' => 'php:Y-m-d',
    							    'options' => [
    											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
    									],
    							],
                ],
             ],
          ],   
          [     
              'columns' => [ 
                [ 'attribute' => 'GeburtsDatum',
                	'format' => ['date', 'php:d.m.Y'],
                	'type' => DetailView::INPUT_WIDGET,
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                	'widgetOptions' => [
                			'class' => DateControl::classname(),
    									'type' => DateControl::FORMAT_DATE,
    							    'displayFormat' => 'php:d.m.Y',
    							    'saveFormat' => 'php:Y-m-d',
    							    'options' => [
    											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
    									],
    							]
                ],
                  ['group'=>true,
                   'valueColOptions'=>['style'=>'width:5%;'],
                   'groupOptions'=>['style'=>'background: #d9edf7;'],
                  ],
                 ['attribute'=>'PTwarDa','type'=>DetailView::INPUT_CHECKBOX_X, //'format' => 'boolean',    
    							'value' => $model->showTriState($model->PTwarDa),
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
      							'widgetOptions' => [
    										'id' => 'ptwd',				
    										'pluginOptions'=>[  
    											'threeState' => false, 
    										],
    							],
    						 ],                         
              ],
          ],   
          [     
              'columns' => [ 
                  [ 'attribute' => 'Strasse',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                  ],
                  ['group'=>true,
                   'valueColOptions'=>['style'=>'width:5%;'],
                   'groupOptions'=>['style'=>'background: #d9edf7;'],
                  ],
                   ['attribute'=>'VertragAbgeschlossen','type'=>DetailView::INPUT_CHECKBOX_X, //'format' => 'boolean',    
      							'value' => $model->showTriState($model->VertragAbgeschlossen),
                    'label'	=> 'Vertrag',			
                    'valueColOptions'=>['style'=>'width:30%'], 
                    'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
      							'widgetOptions' => [				
      										'id' => 'vack',
      										'pluginOptions'=>[  
      											'threeState' => false, 
      										],
      							],
      						 ],
             ],
          ],   
          [     
              'columns' => [ 
                [ 'attribute' => 'PLZ',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                ],
                ['group'=>true,
                 'valueColOptions'=>['style'=>'width:5%;'],
                 'groupOptions'=>['style'=>'background: #d9edf7;'],
                ],
                 ['attribute'=>'VertragMit','type'=>DetailView::INPUT_CHECKBOX_X, //'format' => 'boolean',    
    							'value' => $model->showTriState($model->VertragMit),
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
    							'widgetOptions' => [				
    										'id' => 'vmck',				
    										'pluginOptions'=>[  
    											'threeState' => false, 
    										],
    							],
    						 ],
             ],
          ],   
          [     
              'columns' => [ 
                [ 'attribute' => 'Wohnort',
                   'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
               ],
                ['group'=>true,
                 'valueColOptions'=>['style'=>'width:5%;'],
                 'groupOptions'=>['style'=>'background: #d9edf7;'],
                ],
                 ['attribute'=>'Bemerkung2',
                  'label' => 'Bemerkung',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                 ], 
             ],
          ],   
          [     
              'columns' => [ 
                [ 'attribute' => 'Nationalitaet',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                ],
                ['group'=>true,
                 'valueColOptions'=>['style'=>'width:5%;'],
                 'groupOptions'=>['style'=>'background: #d9edf7;'],
                ],
                 ['attribute'=>'GutscheinVon',
                  'label' => 'Gutschein Von',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                 ], 
             ],
          ],   
          [     
              'columns' => [ 
                [ 'attribute' => 'Beruf',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                ],
                ['group'=>true,
                 'valueColOptions'=>['style'=>'width:5%;'],
                 'groupOptions'=>['style'=>'background: #d9edf7;'],
                ],
             ],
          ],   
          [     
              'columns' => [ 
                [ 'attribute' => 'Telefon1',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                ],
                ['group'=>true,
                 'valueColOptions'=>['style'=>'width:5%;'],
                 'groupOptions'=>['style'=>'background: #d9edf7;'],
                ],
             ],
          ],   
//            'Telefon2',
          [     
              'columns' => [ 
                [ 'attribute' => 'HandyNr',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                ],
                ['group'=>true,
                 'valueColOptions'=>['style'=>'width:5%;'],
                 'groupOptions'=>['style'=>'background: #d9edf7;'],
                ],
             ],
          ],   
//            'Fax',
          [     
              'columns' => [ 
                [ 'attribute' => 'Email',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                ],
                ['group'=>true,
                 'valueColOptions'=>['style'=>'width:5%;'],
                 'groupOptions'=>['style'=>'background: #d9edf7;'],
                ],
            ],
          ],   
          [     
              'columns' => [ 
                [ 'attribute' => 'Funktion',
                	'format' => 'raw',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                	'type' => DetailView::INPUT_SELECT2,
                	'widgetOptions' => [
    									'data' => array_merge(array_merge(["" => ""], ArrayHelper::map( funktion::find()->distinct()->orderBy('FunkId')->all(), 
    									'inhalt', 'inhalt' )),['style'=>'']),
    							 ]             
                ],
                ['group'=>true,
                 'valueColOptions'=>['style'=>'width:5%;'],
                 'groupOptions'=>['style'=>'background: #d9edf7;'],
                ],
             ],
          ],   
          [     
              'columns' => [ 
                [ 'attribute' => 'Sifu',
                	'format' => 'raw',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                	'type' => DetailView::INPUT_SELECT2,
                	'widgetOptions' => [
    									'data' => array_merge(["" => ""], ArrayHelper::map( Sifu::find()->orderBy('sId')->all(), 'SifuName', 'SifuName' )),
    							 ]             
                ],
                ['group'=>true,
                 'valueColOptions'=>['style'=>'width:5%;'],
                 'groupOptions'=>['style'=>'background: #d9edf7;'],
                ],
             ],
          ],   
          [     
              'columns' => [ 
                [ 'attribute' => 'ErzBerechtigter',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                ],
                ['group'=>true,
                 'valueColOptions'=>['style'=>'width:5%;'],
                 'groupOptions'=>['style'=>'background: #d9edf7;'],
                ],
             ],
          ],   
          [     
              'columns' => [ 
                [ 'attribute' => 'Woher',
                	'format' => 'raw',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                	'type' => DetailView::INPUT_SELECT2,
                	'widgetOptions' => [
    									'data' => array_merge(["" => ""], ArrayHelper::map( InteressentVorgaben::find()->andWhere(['code' => "Woher"])->orderBy('sort')->all(), 'wert', 'wert' )),
    							 ],             
                ],
                ['group'=>true,
                 'valueColOptions'=>['style'=>'width:5%;'],
                 'groupOptions'=>['style'=>'background: #d9edf7;'],
                ],
             ],
          ],   
          [     
              'columns' => [ 
        		    [ 'attribute' => 'PruefungZum',
                  'valueColOptions'=>['style'=>'width:30%'], 
                  'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
                ],
                ['group'=>true,
                 'valueColOptions'=>['style'=>'width:5%;'],
                 'groupOptions'=>['style'=>'background: #d9edf7;'],
                ],
             ],
          ],   
        ],
    ]) ?>

 </div>
 <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
     <?= DetailView::widget([
    		'id' => 'dv_va',
        'model' => $model,
				'condensed'=>true,
//				'container' => ['style' => 'font-size:0.9em'],
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}',
				'panel'=>[
					'heading'=>$model->Name . ', ' . $model->Vorname,
					'headingOptions' => ['style' => 'font-size:1em'],
					'type'=>DetailView::TYPE_INFO,					
				],
				'formOptions' => [
							'action' => ['mitglieder/view', 'id' => $model->MitgliederId, 'tabnum' => 1/*, 'style' => 'font-size:1em',*/],
				],
		    'formatter' => [
	        'class' => 'yii\i18n\Formatter',
	        'nullDisplay' => '',
		    ],
				'rowOptions' => [ 'style' => 'font-size:0.85em',
				],
        'valueColOptions'=>['style'=>'width:30%'], 
        'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
        'attributes' => [
           ['attribute' => 'MitgliedsNr',
          	'format' => 'raw',
//            	'class'=>'col-sm-6 table_class',
          	'type' => DetailView::INPUT_SELECT2,
          	'value' => $model->MitgliedsNr,
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'widgetOptions' => [
								'data' => [$model->MitgliedsNr=>$model->MitgliedsNr, 0=>0, $newnr => $newnr ], 
						 ],
           ],
            [ 'attribute' => 'Schulort',
	            'format' => 'raw',
	            'type' => DetailView::INPUT_SELECT2,
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
	            'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( schulen::find()->distinct()->orderBy('SchulId')->all(), 
									'Schulname', 'Schulname' )),
							]
            ],
            [ 'attribute' => 'Anrede',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( Anrede::find()->orderBy('anrId')->all(), 'inhalt', 'inhalt' )),
							 ]             
            ],
            [ 'attribute' => 'Name',
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            ], 
            [ 'attribute' => 'Vorname',
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            ], 
            [ 'attribute' => 'Geschlecht',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ['männlich'=>'männlich','weiblich'=>'weiblich']),
							]
            ],
            [ 'attribute' => 'GeburtsDatum',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            	'widgetOptions' => [
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
            [ 'attribute' => 'Strasse',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            ],
            [ 'attribute' => 'PLZ',
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            ],
            [ 'attribute' => 'Wohnort',
               'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ],
            [ 'attribute' => 'Nationalitaet',
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            ],
          [ 'attribute' => 'Beruf',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          ],
          [ 'attribute' => 'Telefon1',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          ],
          [ 'attribute' => 'HandyNr',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          ],
          [ 'attribute' => 'Email',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          ],
          [ 'attribute' => 'Funktion',
          	'format' => 'raw',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_SELECT2,
          	'widgetOptions' => [
								'data' => array_merge(array_merge(["" => ""], ArrayHelper::map( funktion::find()->distinct()->orderBy('FunkId')->all(), 
								'inhalt', 'inhalt' )),['style'=>'']),
						 ]             
          ],
          [ 'attribute' => 'Sifu',
          	'format' => 'raw',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_SELECT2,
          	'widgetOptions' => [
								'data' => array_merge(["" => ""], ArrayHelper::map( Sifu::find()->orderBy('sId')->all(), 'SifuName', 'SifuName' )),
						 ]             
          ],
          [ 'attribute' => 'ErzBerechtigter',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          ],
          [ 'attribute' => 'Woher',
          	'format' => 'raw',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_SELECT2,
          	'widgetOptions' => [
								'data' => array_merge(["" => ""], ArrayHelper::map( InteressentVorgaben::find()->andWhere(['code' => "Woher"])->orderBy('sort')->all(), 'wert', 'wert' )),
						 ],             
          ],   
   		    [ 'attribute' => 'PruefungZum',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          ],   
          [ 'attribute' => 'KontaktAm',
          	'format' => ['date', 'php:d.m.Y'],
            'valueColOptions'=>['style'=>'width:30%;'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_WIDGET,
          	'ajaxConversion' => true,
//        			'nullDisplay' => '<span class="glyphicon glyphicon-question-sign"></span>',
          	'widgetOptions' => [
          			'class' => DateControl::classname(),
								'type' => DateControl::FORMAT_DATE,
						    'displayFormat' => 'php:d.m.Y',
						    'saveFormat' => 'php:Y-m-d',
						    'options' => [
										'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
								],
						],
          ],
          [ 'attribute' => 'KontaktArt',
          	'format' => 'raw',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_SELECT2,
          	'widgetOptions' => [
								'data' => array_merge(["" => ""], ArrayHelper::map( InteressentVorgaben::find()->andWhere(['code' => "KontaktArt"])->orderBy('sort')->all(), 'wert', 'wert' )),
						 ],             
          ],
          [ 'attribute' => 'Disziplin',
          	'format' => 'raw',
          'valueColOptions'=>['style'=>'width:30%'], 
          'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_SELECT2,
          	'widgetOptions' => [
								'data' => array_merge(["" => ""], ArrayHelper::map( Disziplinen::find()->orderBy('sort')->all(), 'DispName', 'DispName' )),
						 ],             
          ],
          [ 'attribute' => 'EinladungIAzum',
          	'format' => ['date', 'php:d.m.Y'],
          'valueColOptions'=>['style'=>'width:30%'], 
          'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_WIDGET,
          	'ajaxConversion' => true,
   					'label' => 'Info-Abend am',
         	  'widgetOptions' => [
          			'class' => DateControl::classname(),
								'type' => DateControl::FORMAT_DATE,
						    'displayFormat' => 'php:d.m.Y',
						    'saveFormat' => 'php:Y-m-d',
                'options' => [
										'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
  							    ],
						],
          ],
          [ 'attribute'=>'WarZumIAda', 
          'valueColOptions'=>['style'=>'width:30%'], 
          'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
					  'type'=>DetailView::INPUT_CHECKBOX_X,    
						'value' => $model->showTriState($model->WarZumIAda),
  					'autoLabel' => true,
  					'label' => 'War zum IA da',
						'widgetOptions' => [
									'id' => 'wziad',				
									'pluginOptions'=>[  
										'threeState' => false, 
									],
						],
					],
          [ 'attribute' => 'ProbetrainingAm',
          	'format' => ['date', 'php:d.m.Y'],
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_WIDGET,
            'label' => 'Probetr. am',
          	'ajaxConversion' => true,
          	'widgetOptions' => [
          			'class' => DateControl::classname(),
								'type' => DateControl::FORMAT_DATE,
						    'displayFormat' => 'php:d.m.Y',
						    'saveFormat' => 'php:Y-m-d',
						    'options' => [
										'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
								],
						],
          ],
           ['attribute'=>'PTwarDa','type'=>DetailView::INPUT_CHECKBOX_X, //'format' => 'boolean',    
						'value' => $model->showTriState($model->PTwarDa),
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
							'widgetOptions' => [
									'id' => 'ptwd',				
									'pluginOptions'=>[  
										'threeState' => false, 
									],
						],
					 ],                         
           ['attribute'=>'VertragAbgeschlossen','type'=>DetailView::INPUT_CHECKBOX_X, //'format' => 'boolean',    
						'value' => $model->showTriState($model->VertragAbgeschlossen),
            'label'	=> 'Vertrag',			
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
						'widgetOptions' => [				
									'id' => 'vack',
									'pluginOptions'=>[  
										'threeState' => false, 
									],
						],
					 ],
           ['attribute'=>'VertragMit','type'=>DetailView::INPUT_CHECKBOX_X, //'format' => 'boolean',    
						'value' => $model->showTriState($model->VertragMit),
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
						'widgetOptions' => [				
									'id' => 'vmck',				
									'pluginOptions'=>[  
										'threeState' => false, 
									],
						],
					 ],
           ['attribute'=>'Bemerkung2',
            'label' => 'Bemerkung',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'GutscheinVon',
            'label' => 'Gutschein Von',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 


        ],
    ]) ?>
    
    <?php 
          echo Html::beginForm('https://nl.wtfb.de/nl.php', 'post', ['enctype' => 'multipart/form-data', 'target' => '_blank', 'id' => 'formswm2'.$model->MitgliederId]);
          echo Html::hiddenInput('MailingListId', 1);
          echo Html::hiddenInput('FormId', 2);
          echo Html::hiddenInput('FormEncoding', 'utf-8');
          echo Html::hiddenInput('u_EMail', $model->Email,['id' => "u_EMail"]);
          echo Html::hiddenInput('u_Gender', ($model->Geschlecht == 'männlich') ? 'm' : 'g',['id' => "u_Gender_f"]);
          echo Html::hiddenInput('u_FirstName', $model->Vorname,['id' => "u_FirstName"]);
          echo Html::hiddenInput('u_LastName', $model->Name,['id' => "u_LastName"]);
          echo Html::hiddenInput('u_Salutation', $model->Anrede,['id' => "u_Salutation"]);
//          echo Html::hiddenInput('u_Birthday', $model->GeburtsDatum,['id' => "u_Birthday"]);
          echo Html::hiddenInput('Action', 'subscribe');
          echo Html::submitButton('In NL-Interessent eintragen', ['class' => 'btn btn-sm btn-default']);
          echo Html::endForm(); 
    ?>
</div>

<?php }?>
