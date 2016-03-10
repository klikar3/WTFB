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

use frontend\models\PruefungslisteForm;
use frontend\models\Disziplinen;
?>
			<?php $form = ActiveForm::begin(['method' => 'get',
																			 'action' => Url::to(['/mitgliederliste/pruefungsliste']), 
																				'fieldConfig'=>['showLabels'=>true],
																				'type' => ActiveForm::TYPE_VERTICAL,							
																			]); ?>
			<?php Modal::begin([ 
				'header' => '<center><h5>Prüfungsliste erstellen</h5></center>',
				'toggleButton' => ['label' => '<i class="fa glyphicon glyphicon-print"></i>', 'class' => 'btn btn-default', 
													'title'=>'Prüfungsliste erstellen','id' => 'mymodal'],
				'footer'=> '<div class="col-sm-offset-4">'.Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default']) .
											Html::submitButton('Erstellen', ['class'=>'btn btn-sm btn-primary', 
															'onclick'=>"this.form.target='_blank';$('mymodal').modal('hide');return true;"]) . "</div>",
				'size' => 'modal-sm'
									
		]);
		?>
		<?=  $form->field($plf, 'pgeb'	 	
//											,['labelOptions' => ['class' => 'col-sm-3'], 'inputOptions' => ['class' => 'col-sm-4 col-md-4']]
				 )
				 ->widget(MaskMoney::classname(), [
							'pluginOptions' => [
									'prefix' => '€ ',
									'suffix' => '',
									'allowNegative' => false
							]
					])
				 ;
		?>
				<?= $form->field($plf, 'datum')->widget(DatePicker::classname(),
																								[ 'value' => date('d.m.Y'), 
																								'options'=>['placeholder'=>'Graduierungsdatum'], 
																								'pluginOptions'=>['autoclose'=>true, 'format' => 'dd.mm.yyyy',
																									'todayHighlight' => true, 'todayBtn' => true,]
																								]); ?>
				<?= $form->field($plf, 'disp')->dropdownList(ArrayHelper::map( Disziplinen::find()->all(), 'DispName', 'DispName' )
			); ?>

		<?php Modal::end();?>
		<?php $form = ActiveForm::end(); ?>
