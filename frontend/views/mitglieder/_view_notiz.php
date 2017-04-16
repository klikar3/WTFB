<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\detail\DetailView;

use frontend\models\Anrede;
use frontend\models\Funktion;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Mitgliedergrade;
use frontend\models\Pruefer;
use frontend\models\Schulen;
use frontend\models\Sifu;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>
 
    <?= DetailView::widget([
        'model' => $model,
				'condensed'=>true,
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'buttons1' => '{update}',
				'panel'=>[
<<<<<<< HEAD
					'heading'=>$model->Name . ', ' . $model->Vorname,
=======
					'heading'=>'Mitglied: ' . $model->Name . ', ' . $model->Vorname,
>>>>>>> refs/remotes/github/master
					'headingOptions' => ['style' => 'font-size:1em'],
					'type'=>DetailView::TYPE_INFO,
				],
				'rowOptions' => [ 'style' => 'font-size:0.85em',
				],
				'formOptions' => [
							'action' => ['mitglieder/view', 'id' => $model->MitgliederId, 'tabnum' => 6 ],
				],
        'attributes' => [
            [ 'attribute' => 'Bemerkung1',
            	'label' => 'Bemerkung',
	            'format' => 'raw',
	            'type' => DetailView::INPUT_TEXTAREA,
//	            'widgetOptions' => [
//									'data' => array_merge(["" => ""], ArrayHelper::map( schulen::find()->distinct()->orderBy('SchulId')->all(), 
//									'Schulname', 'Schulname' )),
//							]
	          ],
//            'Sifu',
            [ 'attribute' => 'AktivPassiv',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ['Aktiv'=>'Aktiv','Passiv'=>'Passiv']),
							],
						],	
            [ 'attribute' => 'LetzteAenderung',
            	'label' => 'Letzte Änderung',
            	'format' => ['date', 'php:d.m.Y H:i:s'],
            	'type' => DetailView::INPUT_WIDGET,
            	'widgetOptions' => [
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATETIME,
 									'ajaxConversion'=>true,
//									'autoWidget' => true,
//									'language' => 'de',
							    'displayFormat' => 'php:d.m.Y H:i:s',
							    'saveFormat' => 'php:Y-m-d H:i:s',
							    'options' => [
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
      ],
    ]) ?>




