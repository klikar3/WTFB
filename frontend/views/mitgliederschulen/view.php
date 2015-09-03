<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\detail\DetailView;

//use frontend\models\Anrede;
//use frontend\models\Funktion;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
//use frontend\models\Mitgliedergrade;
//use frontend\models\Pruefer;
use frontend\models\Schulen;
use frontend\models\Mitgliederschulen;
//use frontend\models\Sifu;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliederschulen */

$this->title = $model->msID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mitgliedervertrag'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mitgliederschulen-view">

    <h1><?php /* echo Html::encode($this->title)*/ ?></h1>

    <p>
          <?= Html::a(Yii::t('app', 'Zurück'), ['mitglieder/view', 'id' => $model->MitgliederId,'tabnum' => 3],['class'=>'btn btn-primary',
		        ]) ?>
    </p>

    <?= DetailView::widget([
    		'id' => 'dv_vmg',
        'model' => $model,
				'condensed'=>true,
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}{delete}',
				'panel'=>[
					'heading'=>'Mitglied: ' . $model->mitglieder->Name . ', ' . $model->mitglieder->Vorname,
					'type'=>DetailView::TYPE_INFO,
				],
        'attributes' => [
//            [ 'attribute' => 'msID',
//            	'format' => 'raw',
//            	'type' => DetailView::INPUT_TEXT,
//            	'displayOnly' => true,
//            ],
//            'msID',
//            'MitgliederId',
            [ 'attribute' => 'SchulId',
            	'value' => $model->schul->SchulDisp,
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(["0" => ""], ArrayHelper::map( Schulen::find()->all(), 
									'SchulId', 'SchulDisp' )),
							 ]             
            ],
//            'SchulId',
            [ 'attribute' => 'Von',
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
            [ 'attribute' => 'Bis',
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
						[ 'attribute' => 'KuendigungAm', 
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
							],
						],
						[ 'attribute' => 'VDauerMonate',  
//            	'value' => $model->schul->VDauerMonate,
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => range( 0, 36, 1 ),
							 ]             
						],
						[ 'attribute' => 'MonatsBeitrag',  ],
						[ 'attribute' => 'ZahlungsArt',  
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => ['Bankeinzug'=>'Bankeinzug','Bar'=>'Bar'],
							 ]             
						],
						[ 'attribute' => 'Zahlungsweise',  
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => ['monatlich'=>'monatlich','vierteljährlich'=>'vierteljährlich','halbjährlich'=>'halbjährlich','jährlich'=>'jährlich'],
							 ]             
						],
						[ 'attribute' => 'BeitragAussetzenVon', 'format' => ['date', 'php:d.m.Y'], 
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
						[ 'attribute' => 'BeitragAussetzenBis', 'format' => ['date', 'php:d.m.Y'], 
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
						[ 'attribute' => 'BeitragAussetzenGrund',  ],
						[ 'attribute' => 'VertragId',  ],
        ],
    ]) ?>

</div>
