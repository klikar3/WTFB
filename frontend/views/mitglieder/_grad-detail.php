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
    		'id' => 'dv_vv_'.$model->mgID,
        'model' => $model,
				'condensed'=>true,
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}',
				'panel'=>[
					'heading'=>'&nbsp;', // Grad # ' . $model->mgID,
					'type'=>DetailView::TYPE_INFO,
				],
				'formOptions' => [
							'action' => ['mitgliedergrade/viewfrommitglied', 'id' => $model->mgID, 'tabnum' => 3 ],
				],
				'rowOptions' => [ 'style' => 'font-size:0.85em',
				],
        'attributes' => [
/*             [ 'attribute' => 'MitgliedId',
            	'id' => 'dv_vv_a_'.$model->mgID,
            ],
           [ 'attribute' => 'GradId',
            	'id' => 'dv_vv_mb_'.$model->mgID,
            ], */
            [ 'attribute' => 'GradId',
            	'id' => 'dv_vv_mg_'.$model->mgID,
            	'value' => $model->grad->gKurz . " " . $model->grad->DispName,
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'label' => 'Grad',
            	'widgetOptions' => [
									'data' => array_merge(["0" => ""], ArrayHelper::map( Grade::find()->all(), 'gradId', 'gKurz', 'DispName' )),
							    'options' => [
				            	'id' => 'dv_vv_g_'.$model->mgID,											
									],
							 ]             
            ],
            [ 'attribute' => 'Datum',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
            	'ajaxConversion' => true,
            	'widgetOptions' => [
            	'id' => 'dv_vv_v_'.$model->mgID,
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATE,
							    'displayFormat' => 'php:d.m.Y',
							    'saveFormat' => 'php:Y-m-d',
							    'options' => [
				            	'id' => 'dv_vv_v_'.$model->mgID,											
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true],
									],
							]
            ],
            [ 'attribute' => 'PrueferId',
							'id' => 'prueferid_'.$model->mgID,
            	'value' => $model->pruefer->pName,
            	'format' => 'raw',
            	'ajaxConversion' => true,
            	'type' => DetailView::INPUT_SELECT2,
            	'label' => 'Prüfer',
            	'widgetOptions' => [
									'name' => 'schulid_w_'.$model->mgID,
//									'data' => array_merge(["0" => ""], ArrayHelper::map( Pruefer::find()->all(), 
									'data' => ArrayHelper::map( Pruefer::find()->all(), 
									'prueferId', 'pName' ),
							    'options' => [ 
				            	'id' => 'dv_vv_si_o_'.$model->mgID,											
//									    'pluginOptions' => [
//									        'allowClear' => true,
//									    ],
									],
							 ]             
            ],    
       ],
    ]);  ?>


