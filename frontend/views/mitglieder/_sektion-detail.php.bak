<?php

use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
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
use frontend\models\Sektionen;
use frontend\models\GradeSearch;
use frontend\models\Pruefer;
use frontend\models\Schulen;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>
    <?= DetailView::widget([
    		'id' => 'dv_vv_'.$model->msekt_id,
        'model' => $model,
				'condensed'=>true,
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}',
				'panel'=>[
					'heading'=>'&nbsp;', // Grad # ' . $model->mgID,
          'headingOptions' => [
              'class' => 'card-header my-card text-white',
          ],
					'type'=>DetailView::TYPE_INFO,
				],
		    'formatter' => [
		        'class' => 'yii\i18n\Formatter',
		        'nullDisplay' => '',
		    ],
				'formOptions' => [
							'action' => ['mitgliedersektionen/viewfrommitglied', 'id' => $model->msekt_id, 'tabnum' => 3 ],
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
        'attributes' => [
/*             [ 'attribute' => 'MitgliedId',
            	'id' => 'dv_vv_a_'.$model->mgID,
            ],
           [ 'attribute' => 'GradId',
            	'id' => 'dv_vv_mb_'.$model->mgID,
            ], */
            [ 'attribute' => 'sektion_id',
            	'id' => 'dv_vv_mg_'.$model->msekt_id,
            	'value' => $model->sektion->name,
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'label' => 'Programm',
            	'widgetOptions' => [
									'data' => $sektionen_zur_auswahl,
							    'options' => [
				            	'id' => 'dv_vv_g_'.$model->msekt_id,											
									],
							 ]             
            ],
             [ 'attribute' => 'pruefer_id',
							'id' => 'prueferid_'.$model->msekt_id,
            	'value' => $model->pruefer->pName,
            	'format' => 'raw',
            	'ajaxConversion' => true,
            	'type' => DetailView::INPUT_SELECT2,
            	'label' => 'Prüfer',
            	'widgetOptions' => [
									'name' => 'schulid_w_'.$model->msekt_id,
//									'data' => array_merge(["0" => ""], ArrayHelper::map( Pruefer::find()->all(), 
									'data' => $pruefer_zur_auswahl,
							    'options' => [ 
				            	'id' => 'dv_vv_si_o_'.$model->msekt_id,											
//									    'pluginOptions' => [
//									        'allowClear' => true,
//									    ],
									],
							 ]             
            ],    
           [ 'attribute' => 'pdatum',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
              'label' => 'Datum',  
            	'widgetOptions' => [
            	'id' => 'dv_vv_v_'.$model->msekt_id,
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
				            	'id' => 'dv_vv_v_'.$model->msekt_id,											
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true],
									],
							]
            ],
       ],
    ]);  ?>


