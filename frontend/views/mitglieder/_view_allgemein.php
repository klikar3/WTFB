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
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}',
				'panel'=>[
					'heading'=>'Mitglied: ' . $model->Name . ', ' . $model->Vorname,
					'type'=>DetailView::TYPE_INFO,
				],
				'formOptions' => [
							'action' => ['mitglieder/view', 'id' => $model->MitgliederId, 'tabnum' => 1, ],
				],
        'attributes' => [
            [ 'attribute' => 'MitgliedsNr',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'value' => $model->MitgliedsNr,
            	'widgetOptions' => [
									'data' => [$model->MitgliedsNr=>$model->MitgliedsNr, 0=>0, $newnr => $newnr ], 
							 ]             
            ],
            [ 'attribute' => 'Anrede',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( Anrede::find()->orderBy('anrId')->all(), 'inhalt', 'inhalt' )),
							 ]             
            ],
            'Vorname',
            'Name',
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
            'Funktion',
            'Sifu',
        		'PruefungZum',
        ],
    ]) ?>




