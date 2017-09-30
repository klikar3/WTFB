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
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Pruefer;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>

    <?= DetailView::widget([
    		'id' => 'dv_vz',
        'model' => $model,
				'condensed'=>true,
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'mainTemplate' => '{detail}',
				'buttons1' => '{update}',
				'panel'=>[
					'heading'=>$model->Name . ', ' . $model->Vorname,
					'headingOptions' => ['style' => 'font-size:1em'],
					'type'=>DetailView::TYPE_INFO,
				],
				'rowOptions' => [ 'style' => 'font-size:0.85em',
				],
				'formOptions' => [
							'action' => ['mitglieder/view', 'id' => $model->MitgliederId, 'tabnum' => 4, ],
				],
        'attributes' => [
              ['attribute' => 'KontoNr',['enableAjaxValidation' => true],'options' => ['onchange' => "changeHidden(\"IBAN\")"]],
              ['attribute' => 'BLZ',['enableAjaxValidation' => true]],
              'Bank',
        		  ['attribute' => 'IBAN',['enableAjaxValidation' => true]],
        		  ['attribute' => 'BIC',['enableAjaxValidation' => true]],
              'Kontoinhaber',
//             'Status',
        ],
    ]); ?>
	Achtung: IBAN wird beim Speichern aus BLZ und Konto-Nr. generiert!
 <div class="row" style="width:250px;margin-bottom:24px;margin-left:0px">
 		<?php	echo Html::a('<div class="btn btn-sm btn-primary"	style="width: 120px; text-align: left;"><span class="glyphicon glyphicon-envelope"></span>&nbsp;IBAN-Rechner</div>', Url::to('https://www.iban-rechner.de'),[
											'title' => Yii::t('app', 'IBAN berechnen / prüfen'),
											'target' => '_blank'
							  	]);   ?>
	</div>
	

