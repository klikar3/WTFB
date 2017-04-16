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
//				'footer'=> '<div class="col-sm-offset-4">'.Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default']) .
//											Html::submitButton('Erstellen', ['class'=>'btn btn-sm btn-primary', 
//															'onclick'=>"this.form.target='_blank';$('mymodal').modal('hide');return true;"]) . "</div>",
				'size' => 'modal-sm'
									
		]);
		?>
	<div class="container-fluid" style="margin-bottom: 8px">
			<div class="row" >  
			  <div class="col-md-offset-1 col-md-10">
		<?=  $form->field($plf, 'pgeb',['labelOptions'=>['style'=>'font-size:0.85em;height:1em;'],
																			 'inputOptions' => ['style'=>'font-size:0.85em;'],
																			 'options' => ['value' => ''],
																			 ])
/*				 ->widget(MaskMoney::classname(), [
							'pluginOptions' => [
									'prefix' => '€ ',
									'suffix' => '',
									'allowNegative' => false
							],
							'options' => ['style'=>'']
					])
				 ;    */
		?>
				<?= $form->field($plf, 'datum',['labelOptions'=>['style'=>'font-size:0.85em;height:1em;'],
																			 'inputOptions' => ['style'=>'font-size:0.85em;h']
																			 ])->widget(DatePicker::classname(),
																							[ 'value' => date('d.m.Y'), 
																								'options'=>[//'placeholder'=>'Graduierungsdatum',
																														'style'=>''], 
																								'pluginOptions'=>['autoclose'=>true, 'format' => 'dd.mm.yyyy',
																										'todayHighlight' => true, 'todayBtn' => true,'style'=>'']
																							]); 
				?>
				<?= $form->field($plf, 'disp',['labelOptions'=>['style'=>'font-size:0.85em;height:1em;padding-top:1.6em;'],
																			 'inputOptions' => ['style'=>'font-size:0.85em;']
																			 ])->dropdownList(ArrayHelper::map( Disziplinen::find()->all(), 'DispName', 'DispName' )
																			 									,['style'=>'']
			); ?>
			<div style="float:right;"> <br>
				<?= Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default', 'style'=>"margin-right:5px;"]) . "  &nbsp;" . 
						Html::submitButton('Erstellen', ['class'=>'btn btn-sm btn-primary', 
															'onclick'=>"this.form.target='_blank';$('mymodal').modal('hide');return true;"]);
				?>
			</div>
			</div>
		</div>
	</div>

		<?php Modal::end();?>
		<?php $form = ActiveForm::end(); ?>
