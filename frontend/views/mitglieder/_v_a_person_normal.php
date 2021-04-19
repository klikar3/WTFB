<?php

use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
//use yii\bootstrap4\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\VarDumper;
//use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\detail\DetailView;
//use kartik\popover\PopoverX;

use frontend\models\Anrede;
use frontend\models\Funktion;
//use frontend\models\Disziplinen;
//use frontend\models\DisziplinenSearch;
//use frontend\models\Grade;
//use frontend\models\GradeSearch;
//use frontend\models\InteressentVorgaben;
use frontend\models\Mitglieder;
//use frontend\models\Mitgliedergrade;
use frontend\models\Pruefer;
use frontend\models\Schulen;
use frontend\models\Sifu;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */


?>

<div class="col-md-6" name="va_pn">   
       <?= DetailView::widget([
    		'id' => 'dv_va_n',
        'model' => $model,
        'fadeDelay' => 50,
				'condensed'=>true,
        'showErrorSummary' => true,
//				'container' => ['style' => 'font-size:0.9em'],
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}',
				'panel'=>[
					'heading'=>'Person', //$model->Name . ', ' . $model->Vorname,
					'headingOptions' => ['style' => 'font-size:1em;background-color: #3c68b1 !important;'],
					'type'=>DetailView::TYPE_INFO,					
				],
				'formOptions' => [
							'action' => ['mitglieder/view', 'id' => $model->MitgliederId, 'tabnum' => 1/*, 'style' => 'font-size:1em',*/],
				],
		    'formatter' => [
	        'class' => 'yii\i18n\Formatter',
	        'nullDisplay' => '',
		    ],
        'i18n' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@kvdetail/messages',
            'forceTranslation' => true,
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
//              'value' => $schulorte[$model->Schulort],
	            'type' => DetailView::INPUT_SELECT2,
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
	            'widgetOptions' => [
									'data' => $schulorte,
							]
            ],
            [ 'attribute' => 'Anrede',
            	'format' => 'raw',
              'name' => 'dw_p_anr',
            	'type' => DetailView::INPUT_SELECT2,
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            	'widgetOptions' => [
									'data' => $anreden,
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
									'data' => array_merge(["" => ""], ['männlich'=> Yii::t('app', 'male'), 'weiblich' => Yii::t('app', 'female')]),
							]
            ],
            [ 'attribute' => 'GeburtsDatum',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
              'valueColOptions'=>['style'=>'width:30%'], 
              'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
            	'widgetOptions' => [
            			'class' => datecontrol::classname(),
									'type' => datecontrol::FORMAT_DATE,
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
								'data' => $functions,
						 ]             
          ],
          [ 'attribute' => 'Sifu',
          	'format' => 'raw',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          	'type' => DetailView::INPUT_SELECT2,
          	'widgetOptions' => [
								'data' => $sifus,
						 ]             
          ],
          [ 'attribute' => 'ErzBerechtigter',
            'valueColOptions'=>['style'=>'width:30%'], 
            'labelColOptions'=>['style'=>'width:19%;text-align:right;'], 
          ],
    ],]); ?>
  
</div>

