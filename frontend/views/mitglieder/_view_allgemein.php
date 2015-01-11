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
					'heading'=>'Mitglied # ' . $model->MitgliedsNr,
					'type'=>DetailView::TYPE_INFO,
				],
        'attributes' => [
            [ 'attribute' => 'MitgliedsNr',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
//            	'value' => $model->MitgliedsNr,
            	'widgetOptions' => [
									'data' => [  $model->MitgliedsNr, 0, $newnr ],//array_merge(["" => ""]), 
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
							    'displayFormat' => 'd.m.Y',
							    'saveFormat' => 'Y-m-d'
							]
            ],
            'Strasse',
            'PLZ',
            'Wohnort',
            'Nationalitaet',
            'Beruf',
            'Telefon1',
            'Telefon2',
            'HandyNr',
            'Fax',
            'Email:email',
        		'PruefungZum',
        ],
    ]) ?>




