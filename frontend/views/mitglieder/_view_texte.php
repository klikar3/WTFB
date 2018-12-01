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
use frontend\models\Numbers;
use frontend\models\Pruefer;
use frontend\models\Schulen;
use frontend\models\Sifu;
use frontend\models\Texte;
 
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
					'heading'=> 'Texte...', //$model->Name . ', ' . $model->Vorname,
					'headingOptions' => ['style' => 'font-size:1em'],
					'type'=>DetailView::TYPE_INFO,
				],
				'rowOptions' => [ 'style' => 'font-size:0.85em',
				],
				'formOptions' => [
							'action' => ['mitglieder/view', 'id' => $model->MitgliederId, 'tabnum' => 6 ],
				],
		    'formatter' => [
	        'class' => 'yii\i18n\Formatter',
	        'nullDisplay' => '',
		    ],
        'attributes' => [
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
            [ 'attribute' => 'LetztAendSifu',
            	'label' => 'Letzte Änderung Sifu',
            	'format' => ['date', 'php:d.m.Y H:i:s'],
            	'type' => DetailView::INPUT_WIDGET,
            	'widgetOptions' => [
            			'class' => DateControl::classname(),
									'type' => DateControl::FORMAT_DATETIME,
 									'ajaxConversion'=>true,
//									'autoWidget' => true,
//									'language' => 'de',
									'displayTimezone' => 'Europe/Berlin',
							    'displayFormat' => 'php:d.m.Y H:i:s',
							    'saveFormat' => 'php:Y-m-d H:i:s',
							    'options' => [
											'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true,],
									],
							]
            ],
      ],
    ]) ?>

			<?php
			 $txtid = new Numbers();
			 $txtid->id = 0;
       if (Yii::$app->user->identity->isAdmin /*role == 10*/) {
					 $form = ActiveForm::begin( ['action' => Url::to(['texte/print',
																										'datamodel' => 'mitglieder',
																										'dataid' => $model->MitgliederId,
																										'txtid' => $txtid->id,
																										'txtcode' => '',
																										'SchulId' => 0,				
																										'target' => '_blank', ]),
																			'type' => ActiveForm::TYPE_HORIZONTAL,																																
																			'method' => 'post',
																			'options' => [ 'target' => '_blank']
		//															[	$id = 'mg-pr-txt'
													]	); 
					?>
						<div class="col-xs-offset-3">
							<?= $form->field($txtid, 'id')->dropDownList( array_merge([0 => ""], ArrayHelper::map( Texte::find()->andWhere('fuer LIKE "mitglieder" ')->all(), 'id', 'code', 'schul.Schulname' ))
//												, ['style'=>'width:200px']											
		//									[ 'prompt' => 'Text' ]
											)										
									->label('Textauswahl'); 
							?>
							<div style="text-align: right;">  <br>
							<?= Html::resetButton('Rücksetzen', ['class'=>'btn btn-sm btn-default']) . '  ' . 
										Html::submitButton('Auswählen', ['class'=>'btn btn-sm btn-primary']);
							?>
							</div>
						</div>	
					<?php $form = ActiveForm::end();
			}  ?>

