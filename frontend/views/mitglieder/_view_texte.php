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
	<div class="panel panel-info panel-xs" style="font-size:0.9em;height:3em;margin-top:0em;">
			<div class="panel-heading panel-xs" style="height:3em;margin-top:0em;vertical-align:top;">
<<<<<<< HEAD
				<h5 style="padding-top:0em;margin-top:0em;"><?= $model->Name ?>, <?= $model->Vorname ?></h5>
=======
				<h5 style="padding-top:0em;margin-top:0em;">Mitglied: <?= $model->Name ?>, <?= $model->Vorname ?></h5>
>>>>>>> refs/remotes/github/master
			</div>
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



