<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
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
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>
    <?= DetailView::widget([
    		'id' => 'dv_vv_'.$model->msID,
        'model' => $model,
				'condensed'=>true,
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}',
				'panel'=>[
					'heading'=>'Vertrag # ' . $model->msID,
					'type'=>DetailView::TYPE_INFO,
				],
				'formOptions' => [
							'action' => ['mitgliederschulen/viewfrommitglied', 'id' => $model->msID, 'tabnum' => 3 ],
				],
        'attributes' => [
            [ 'attribute' => 'VDauerMonate',
            	'id' => 'dv_vv_a_'.$model->msID,
            ],
            [ 'attribute' => 'MonatsBeitrag',
            	'id' => 'dv_vv_mb_'.$model->msID,
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
//             'SchulId',
            [ 'attribute' => 'SchulId',
							'id' => 'schulid_'.$model->msID,
            	'value' => $model->schul->SchulDisp,
            	'format' => 'raw',
            	'ajaxConversion' => true,
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'name' => 'schulid_w_'.$model->msID,
									'data' => array_merge(["0" => ""], ArrayHelper::map( Schulen::find()->all(), 
									'SchulId', 'SchulDisp' )),
							    'options' => [ 
				            	'id' => 'dv_vv_si_o_'.$model->msID,											
									    'pluginOptions' => [
									        'allowClear' => true,
									    ],
									],
							 ]             
            ],    
//             'ZahlungsArt',
//             'Zahlungsweise',
						[ 'attribute' => 'ZahlungsArt',  
				      'id' => 'dv_vv_za_'.$model->msID,											
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
				          'id' => 'dv_vv_za_w_'.$model->msID,											
									'data' => ['Bankeinzug'=>'Bankeinzug','Bar'=>'Bar'],
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
