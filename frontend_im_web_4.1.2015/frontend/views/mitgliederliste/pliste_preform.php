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
			<?php $form = ActiveForm::begin(['action' => ['/mitgliederliste/pruefungsliste'],
																				'fieldConfig'=>['showLabels'=>true],
																				'type' => ActiveForm::TYPE_VERTICAL,							
																			]); ?>
			<?php Modal::begin([ 
				'header' => '<h2>Prüfungsliste erstellen</h2>',
				'toggleButton' => ['label' => '<i class="fa glyphicon glyphicon-print"></i> Liste erstellen', 'class' => 'btn btn-default'],
				'footer'=>Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) .
									Html::resetButton('Reset', ['class'=>'btn btn-sm btn-default'])
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
				[ 'value' => date('d.m.Y'), 'options'=>['placeholder'=>'Graduierungsdatum'], 'pluginOptions'=>['autoclose'=>true, 'format' => 'dd.mm.yyyy',
					'todayHighlight' => true, 'todayBtn' => true,
					]]); ?>
				<?= $form->field($plf, 'disp')->dropdownList(ArrayHelper::map( Disziplinen::find()->all(), 'DispName', 'DispName' )
			); ?>
		<?php Modal::end();?>
		<?php $form = ActiveForm::end(); ?>
