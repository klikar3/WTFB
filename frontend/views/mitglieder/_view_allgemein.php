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
        'attributes' => [
            [ 'attribute' => 'MitgliedsNr',
            	'format' => 'raw',
//            	'class'=>'col-sm-6 table_class',
            	'type' => DetailView::INPUT_SELECT2,
            	'value' => $model->MitgliedsNr,
            	'widgetOptions' => [
									'data' => [$model->MitgliedsNr=>$model->MitgliedsNr, 0=>0, $newnr => $newnr ], 
							 ],
//							 'inputContainer' => ['class'=>'col-sm-6 table_class'],            
            ],
            [ 'attribute' => 'Schulort',
	            'format' => 'raw',
	            'type' => DetailView::INPUT_SELECT2,
	            'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( schulen::find()->distinct()->orderBy('SchulId')->all(), 
									'Schulname', 'Schulname' )),
							]
	          ],
            [ 'attribute' => 'Anrede',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( Anrede::find()->orderBy('anrId')->all(), 'inhalt', 'inhalt' )),
							 ]             
            ],
            'Name',
            'Vorname',
            [ 'attribute' => 'Geschlecht',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ['männlich'=>'männlich','weiblich'=>'weiblich']),
							]
            ],
            [ 'attribute' => 'GeburtsDatum',
            	'format' => ['date', 'php:d.m.Y'],
            	'type' => DetailView::INPUT_WIDGET,
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
            'Strasse',
            'PLZ',
            'Wohnort',
            'Nationalitaet',
            'Beruf',
            'Telefon1',
//            'Telefon2',
            'HandyNr',
//            'Fax',
            'Email:email',
            [ 'attribute' => 'Funktion',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(array_merge(["" => ""], ArrayHelper::map( funktion::find()->distinct()->orderBy('FunkId')->all(), 
									'inhalt', 'inhalt' )),['style'=>'']),
							 ]             
            ],
            [ 'attribute' => 'Sifu',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( Sifu::find()->orderBy('sId')->all(), 'SifuName', 'SifuName' )),
							 ]             
            ],
            'ErzBerechtigter',
            [ 'attribute' => 'Woher',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( InteressentVorgaben::find()->andWhere(['code' => "Woher"])->orderBy('sort')->all(), 'wert', 'wert' )),
							 ],             
            ],
        		'PruefungZum',
        ],
    ]) ?>




