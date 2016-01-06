<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/*use yii\grid\GridView; */
use kartik\grid\GridView;
use kartik\mpdf\Pdf;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\money\MaskMoney;

//use frontend\models\PruefungslisteForm;
use frontend\models\Disziplinen;
use frontend\models\Funktion;
use frontend\models\Schulen;
?>

			<?php $form = ActiveForm::begin(['method' => 'post',
																			 'action' => Url::to(['/mitglieder/create']), 
																				'fieldConfig'=>['showLabels'=>true],
																				'type' => ActiveForm::TYPE_HORIZONTAL,
																				'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL,
																				'showErrors' => true,
																									]												
																			]); ?>
			<?php Modal::begin([ 'id' => 'mg-cr-mod',
				'header' => '<center><h2>Mitglied anlegen</h2></center>',
				'toggleButton' => ['label' => '<i class="fa glyphicon glyphicon-plus"></i>', 'class' => 'btn btn-success', 
													'title'=>'Mitglied anlegen'],
				'footer'=>Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default']) .
									Html::submitButton('Erstellen', ['class'=>'btn btn-sm btn-primary']) 									
		]);
		?>
	<div class="row" style="margin-bottom: 8px">
		<div class="col-sm-10">
		<?=  $form->field($mcf, 'MitgliederId')->hiddenInput()->label('');
		?>
		</div>
		<div class="col-sm-10">
		<?=  $form->field($mcf, 'Vorname');
		?>
		</div>
		<div class="col-sm-10">
		<?=  $form->field($mcf, 'Name');
		?>
		</div>
		<div class="col-sm-10">
				<?= $form->field($mcf, 'Geschlecht')->dropdownList(array_merge(["" => ""], ['männlich'=>'männlich','weiblich'=>'weiblich'])
			); ?>
			
		</div>
		<div class="col-sm-10">
				<?php /* echo $form->field($mcf, 'BeitrittDatum')->widget(DatePicker::classname(),
																								[ 'value' => date('d.m.Y'), 
																								'options'=>['placeholder'=>'Graduierungsdatum'], 
																								'pluginOptions'=>['autoclose'=>true, 'format' => 'dd.mm.yyyy',
																									'todayHighlight' => true, 'todayBtn' => true,]
																								]); */?>

        <?= $form->field($mcf, 'Schulort')->dropdownList(array_merge(["" => ""], ArrayHelper::map( Schulen::find()->all()/*->distinct()->orderBy('SchulId')->all()*/, 
									'Schulname', 'Schulname' )));
				?>

		</div>
		<div class="col-sm-10">
        <?= $form->field($mcf, 'Funktion')->dropdownList(array_merge(["" => ""], ArrayHelper::map( funktion::find()->distinct()->orderBy('FunkId')->all(), 
									'inhalt', 'inhalt' )));
				?>
		</div>
	</div>
		<?php Modal::end();?>
		<?php $form = ActiveForm::end(); ?>
