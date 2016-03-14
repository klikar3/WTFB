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
		<div class="panel panel-info" style="font-size:0.9em;">
			<div class="panel-heading panel-xs" style="margin-bottom: 8px;">
				<center><h5>Texte für <?= $model->Name ?>, <?= $model->Vorname ?></h5></center>
			</div>		
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
						<div class="col-sm-offset-3 col-md-offset-4 col-lg-offset-5">
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
		</div>



