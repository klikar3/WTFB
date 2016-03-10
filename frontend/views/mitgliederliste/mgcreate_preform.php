<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
/*use yii\grid\GridView; */
use kartik\grid\GridView;
use kartik\mpdf\Pdf;
use kartik\widgets\ActiveForm;
//use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\money\MaskMoney;

//use frontend\models\PruefungslisteForm;
use frontend\models\Disziplinen;
use frontend\models\Funktion;
use frontend\models\Schulen;
?>

			<?php Modal::begin([ 'id' => 'mg-cr-mod',
				'header' => '<center><h5>Mitglied anlegen</h5></center>',
				'toggleButton' => ['label' => '<i class="fa glyphicon glyphicon-plus"></i>', 'class' => 'btn btn-success', 
													'title'=>'Mitglied anlegen'],
				'size'=>'modal-md',					
//				'footer'=>Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default']) . Html::submitButton('Erstellen', ['class'=>'btn btn-sm btn-primary']) 									
		]);
		?>
			<?php $form = ActiveForm::begin(['method' => 'post',
																			 'action' => Url::to(['/mitglieder/create']),
																			 'enableClientValidation' => true,
																				'enableAjaxValidation' => false, 
																				'fieldConfig'=>['showLabels'=>true],
																				'type' => ActiveForm::TYPE_HORIZONTAL,
																				'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL,
																													'showErrors' => true,
																				],												
																			]); ?>
	<div class="row" style="margin-bottom: 8px">
		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
			<div class="row"> 
				<?= $form->field($mcf, 'MitgliederId')->hiddenInput()->label('');
				?>
				<?= $form->field($mcf, 'Vorname');
				?>
				<?= $form->field($mcf, 'Name');
				?>
				<?= $form->field($mcf, 'Geschlecht')->dropdownList(array_merge(["" => ""], ['männlich'=>'männlich','weiblich'=>'weiblich'])); 
				?>
			
				<?php /* echo $form->field($mcf, 'BeitrittDatum')->widget(DatePicker::classname(),
																								[ 'value' => date('d.m.Y'), 
																								'options'=>['placeholder'=>'Graduierungsdatum'], 
																								'pluginOptions'=>['autoclose'=>true, 'format' => 'dd.mm.yyyy',
																									'todayHighlight' => true, 'todayBtn' => true,]
																								]); */?>

        <?= $form->field($mcf, 'Schulort')->dropdownList(array_merge(["" => ""], ArrayHelper::map( Schulen::find()->all()/*->distinct()->orderBy('SchulId')->all()*/, 
									'Schulname', 'Schulname' )));
				?>

        <?= $form->field($mcf, 'Funktion')->dropdownList(array_merge(["" => ""], ArrayHelper::map( funktion::find()->distinct()->orderBy('FunkId')->all(), 
									'inhalt', 'inhalt' )));
				?>
			</div>	
			<div class="col-xs-6 col-xs-offset-8 col-sm-6 col-sm-offset-8" style="text-align:right;"> 
				<?= Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default']) . "&nbsp;" . Html::submitButton('Speichern', ['class'=>'btn btn-sm btn-primary']);
				?>
			</div>
		</div>
	</div>
		<?php $form = ActiveForm::end(); ?>
		<?php Modal::end();?>
