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
 
				<div class="row">
		 		<div class="col-sm-6">

            <div id="content" >
    <?= DetailView::widget([
        'model' => $model,
				'condensed'=>true,
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'panel'=>[
					'heading'=>'Mitglied # ' . $model->MitgliederId,
					'type'=>DetailView::TYPE_INFO,
				],
        'attributes' => [
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
        		'PruefungZum',
        ],
    ]) ?>

            </div><!-- content -->
        </div> <!-- col -->

		 		<div class="col-sm-6">

            <div id="content" >
    <?= DetailView::widget([
        'model' => $model,
				'condensed'=>true,
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'panel'=>[
					'heading'=>'Mitglied # ' . $model->MitgliederId,
					'type'=>DetailView::TYPE_INFO,
				],
        'attributes' => [
            [ 'attribute' => 'Schulort',
            	'format' => 'raw',
            	'type' => DetailView::INPUT_SELECT2,
            	'widgetOptions' => [
									'data' => array_merge(["" => ""], ArrayHelper::map( schulen::find()->distinct()->orderBy('SchulId')->all(), 
									'Schulname', 'Schulname' )),
							]
            ],
            'Disziplin',
            'Funktion',
            'Sifu',
            'Telefon1',
            'Telefon2',
            'HandyNr',
            'Fax',
            'LetzteAenderung',
            'Email:email',
      ],
    ]) ?>

            </div><!-- content -->
        </div> <!-- col -->
   
        </div> <!-- row -->



