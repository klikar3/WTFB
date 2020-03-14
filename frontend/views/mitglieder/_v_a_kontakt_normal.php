<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\detail\DetailView;

use frontend\models\Disziplinen;
use frontend\models\InteressentVorgaben;
use frontend\models\Schulen;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>
<div class="col-md-6">
       <?= DetailView::widget([
    		'id' => 'dv_vb_n',
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
          [ 'attribute' => 'kontaktNachricht1',
          	'label' => 'Kontakt-Nachricht',
            'format' => 'raw',
            'type' => DetailView::INPUT_TEXTAREA,
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
          [ 'attribute'=>'IABest', 
          'valueColOptions'=>['style'=>'width:30%'], 
          'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
					  'type'=>DetailView::INPUT_CHECKBOX_X,    
						'value' => $model->showTriState($model->IABest),
  					'autoLabel' => true,
  					'label' => 'IA best',
						'widgetOptions' => [
									'id' => 'wziabe',				
									'pluginOptions'=>[  
										'threeState' => true, 
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
										'threeState' => true, 
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
										'threeState' => true, 
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
										'threeState' => true, 
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
										'threeState' => true, 
									],
						],
					 ],
          [ 'attribute' => 'wiederVorlageAm',
          	'format' => ['date', 'php:d.m.Y'],
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_WIDGET,
          	'ajaxConversion' => true,
   					'label' => 'Wiedervorlage am',
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
           ['attribute'=>'letzteDvd',
            'label' => 'Letzte DVD',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
           ], 
           ['attribute'=>'DVDgesendetAm',
            'format' => ['date', 'php:d.m.Y'],
            'label' => 'DVD am',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_WIDGET,
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
        $disp = Disziplinen::find()->andWhere(['DispName' => $model->Disziplin])->select('DispId')->one();        
        $schul = Schulen::find()->andWhere(['Schulname' => $model->Schulort, 'Disziplin' => $disp])->one();
//        \Yii::warning($model);
//        \Yii::warning($schul);
        if ((!empty($schul)) && ($schul->swmInteressentenListe != 0 ) && ($schul->swmInteressentenForm != 0 )) {
            echo Html::beginForm('https://nl.wtfb.de/nl.php', 'post', ['enctype' => 'multipart/form-data', 'target' => '_blank', 'id' => 'formswm'.$model->MitgliederId]);
            echo Html::hiddenInput('MailingListId', $schul->swmInteressentenListe);
            echo Html::hiddenInput('FormId', $schul->swmInteressentenForm);
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
        }    
    ?>

</div>
