<?php

use yii\helpers\ArrayHelper;
use yii\bootstrap4\BaseHtml;
//use yii\helpers\BaseHtml;
//use yii\helpers\Html;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\bootstrap4\Modal;
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
							<div class="panel-info wtfb-light" style="color:#337ab7;">																	
			<?php Modal::begin([ 'id' => 'mg-e-cr-mod',
				'title' => '<center><h5>Neues Mitglied aus Email anlegen</h5></center>',
				'toggleButton' => ['label' => '<i class="fa fa-plus"></i>&nbsp;<i class="fa fa-envelope"></i>', 'class' => 'btn btn-success', 
													'title'=>'Neues Mitglied aus Email anlegen'],
				'size'=>'modal-md',
        'headerOptions' => ['class' => 'card-header my-card text-white'],
				'clientOptions' => [ 'style' => 'adjust:center;',
											'backdrop' => true,
											'keyboard' => true,
				],					
//				'footer' =>  false, //'<div style="float: right;">'.Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default', 'style'=>"margin-right:5px;"]) . "  &nbsp;" . 
//						Html::submitButton('Speichern', ['class'=>'btn btn-sm btn-primary']).'</div>',
//				'footer'=>Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default']) . Html::submitButton('Erstellen', ['class'=>'btn btn-sm btn-primary']) 									
		]);
		?>

			<?php $form = ActiveForm::begin([ 'method' => 'post',
																			  'action' => Url::to(['/mitglieder/createfromemail']),
																			  'enableClientValidation' => true,
																				'enableAjaxValidation' => false, 
																				'fieldConfig'=>['showLabels'=>true],
																				'type' => ActiveForm::TYPE_HORIZONTAL,
																				'formConfig' => [ 'labelSpan' => 3, 
																													'deviceSize' => ActiveForm::SIZE_MEDIUM,
																													'showErrors' => true,
																				],
//																				'options'=>['style'=>'width:20em;margin:0px;']												
																			]); ?>
				<?php if($mcf->hasErrors()){
						  	echo BaseHtml::errorSummary($mcf);
							} 
				?>																			
							<div class="row">																	
							<div class="col-1">
							</div>
							<div class="col-10">
				<?= $form->field($mcf, 'emailInhalt',['labelOptions'=>['style'=>''],
																			 'inputOptions' => ['style'=>'']])
                  ->textarea(['rows' => '6', 'placeholder' => 'Hier die Felder der Email rein kopieren... '])->label('EmailInhalt') 
				?>
			
				<?php /* echo $form->field($mcf, 'BeitrittDatum')->widget(DatePicker::classname(),   width:16em;
																								[ 'value' => date('d.m.Y'), 
																								'options'=>['placeholder'=>'Graduierungsdatum'], 
																								'pluginOptions'=>['autoclose'=>true, 'format' => 'dd.mm.yyyy',
																									'todayHighlight' => true, 'todayBtn' => true,]
																								]); */?>

        <?= $form->field($mcf, 'Schulort',)->dropdownList(array_merge(["" => ""], ArrayHelper::map( Schulen::find()->all()/*->distinct()->orderBy('SchulId')->all()*/, 
									'Schulname', 'Schulname' )),['style'=>'']);
				?>


        <?= $form->field($mcf, 'Disziplin',)->dropdownList(array_merge(["" => ""], ArrayHelper::map( Disziplinen::find()->all()/*->distinct()->orderBy('SchulId')->all()*/, 
									'DispName', 'DispName' )),['style'=>'']);
				?>

        <?= $form->field($mcf, 'KontaktAm',)->widget(datecontrol::classname(), [
    							'type'=>datecontrol::FORMAT_DATE,
    							'ajaxConversion'=>true,
     							'displayFormat' => 'php:d.m.Y',
     							'saveFormat' => 'php:Y-m-d',
    							'value' => 'KontaktAm',
    							'options' => [
    //							'placeholder' => 'Graduierungsdatum ...'],
    								'pluginOptions' => [	
    										'autoclose'=>true
    								] 
    							]
    						]) 
    		?>
        
        <?= $form->field($mcf, 'Funktion',)->dropdownList(array_merge(["" => ""], ArrayHelper::map( funktion::find()->distinct()->orderBy('FunkId')->all(), 
									'inhalt', 'inhalt' )),['style'=>'']);
				?>
				<?= $form->field($mcf, 'MitgliederId',['labelOptions'=>['style'=>'font-size:0em;height:0em;padding-top:0em;'],
																			 'inputOptions' => ['style'=>'width:0em;font-size:0em;height:0em;'],
																			 'options' => ['style'=>'width:0em;font-size:0em;height:0em;'],
																			 ])->hiddenInput(['style'=>'width:0em;height:0em;padding:0em;'])
//																			 ->label('',['style'=>'width:0em;height:0em;padding:0em;']);
//																			 ->label('none');
				?>
			<div style="float:right;margin-bottom: 8px;"> <br>
				<?= Html::resetButton('Zurücksetzen', ['class'=>'btn btn-sm btn-default', 'style'=>"margin-right:5px;"]) . "  &nbsp;" . 
						Html::submitButton('Erstellen', ['class'=>'btn btn-sm btn-primary', 
//															'onclick'=>"this.form.target='_blank';$('mymodal').modal('hide');return true;"]);
															'onclick'=>"$('mymodal').modal('hide');return true;"]);
				?>
			</div>
			</div>
		<?php $form = ActiveForm::end(); ?>
		</div>
		<?php Modal::end();
		
		// class="col-xs-8 col-xs-offset-1 col-sm-8 col-sm-offset-1"                      class="col-md-offset-4 
		//col-xs-11 col-sm-11 col-md-11 col-lg-11 
		//    col-md-offset-2"  		   				style="text-align:right;"
		?>

</div>		