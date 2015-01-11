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
																			]); ?>
			<?php Modal::begin([ 
				'header' => '<h2>Mitglied anlegen</h2>',
				'toggleButton' => ['label' => '<i class="fa glyphicon glyphicon-plus"></i>', 'class' => 'btn btn-default', 
													'title'=>'Mitglied anlegen'],
				'footer'=>Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) .
									Html::resetButton('Reset', ['class'=>'btn btn-sm btn-default'])
		]);
		?>
		<?=  $form->field($mcf, 'MitgliederId')->hiddenInput();
		?>
		<?=  $form->field($mcf, 'Vorname');
		?>
		<?=  $form->field($mcf, 'Name');
		?>
				<?= $form->field($mcf, 'Geschlecht')->dropdownList(array_merge(["" => ""], ['männlich'=>'männlich','weiblich'=>'weiblich'])
			); ?>
			
				<?php /* echo $form->field($mcf, 'BeitrittDatum')->widget(DatePicker::classname(),
																								[ 'value' => date('d.m.Y'), 
																								'options'=>['placeholder'=>'Graduierungsdatum'], 
																								'pluginOptions'=>['autoclose'=>true, 'format' => 'dd.mm.yyyy',
																									'todayHighlight' => true, 'todayBtn' => true,]
																								]); */?>

        <?= $form->field($mcf, 'Schulort')->dropdownList(array_merge(["" => ""], ArrayHelper::map( schulen::find()->distinct()->orderBy('SchulId')->all(), 
									'Schulname', 'Schulname' )));
				?>

        <?= $form->field($mcf, 'Funktion')->dropdownList(array_merge(["" => ""], ArrayHelper::map( funktion::find()->distinct()->orderBy('FunkId')->all(), 
									'inhalt', 'inhalt' )));
				?>

		<?php Modal::end();?>
		<?php $form = ActiveForm::end(); ?>
