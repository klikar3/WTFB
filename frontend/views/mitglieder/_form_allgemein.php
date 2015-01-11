<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;

use frontend\models\Anrede;
use frontend\models\Funktion;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Mitgliedergrade;
use frontend\models\Pruefer;
use frontend\models\Schulen;
use frontend\models\Sifu;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>
 
<div class="row">
	<div class="col-sm-6">
     <div id="content" >
			<div class="row">
     	      <div class="col-sm-8">
     <?= $form->field($model, 'MitgliedsNr'
//	 		,['labelOptions' => ['class' => 'col-sm-5'], 'inputOptions' => ['class' => 'col-sm-8 ']]
		 )->textInput(['disabled' => true]) ?>
		<?= Html::activeHiddenInput($model, 'MitgliedsNr')?>
		<?= Html::activeHiddenInput($model, 'MitgliederId')?>
						</div>
      </div>
			<div class="row">
						<div class="col-sm-8">
 		 <?= $form->field($model, 'Geschlecht'
//	 		,['labelOptions' => ['class' => 'col-sm-5'], 'inputOptions' => ['class' => 'col-sm-8 ']]
			)->widget(Select2::classname(), [
			'data' => array_merge(["" => ""], ['männlich'=>'männlich','weiblich'=>'weiblich']),
			'options' => ['placeholder' => 'Geschlecht auswählen ...'],
			'pluginOptions' => ['allowClear' => true ], ]);   ?>
							</div> 
      </div>
			<div class="row">
     	      <div class="col-sm-8">
		<?= $form->field($model, 'Anrede')->widget(Select2::classname(), [
					'data' => array_merge(["" => ""], ArrayHelper::map( Anrede::find()->orderBy('anrId')->all(), 'inhalt', 'inhalt' )),
					'options' => ['placeholder' => 'Anrede auswählen ...'],
					'pluginOptions' => ['allowClear' => true ], ]);   ?>
					</div>
      </div>
			<div class="row">
						<div class="col-sm-8">
    <?= $form->field($model, 'GeburtsDatum')->widget(DateControl::classname(), [
							'type'=>DateControl::FORMAT_DATE,
							'ajaxConversion'=>true,
 							'displayFormat' => 'php:d.m.Y',
 							'saveFormat' => 'php:Y-m-d',
							'value' => 'GeburtsDatum',
							'options' => [
//							'placeholder' => 'Graduierungsdatum ...'],
								'pluginOptions' => [	
										'autoclose'=>true
								] 
							]
						]) 
		?>
						</div> 
      </div>
			<div class="row">
     	      <div class="col-sm-8">
   <?= $form->field($model, 'Vorname'
//	 		,['labelOptions' => ['class' => 'col-sm-2'], 'inputOptions' => ['class' => 'col-sm-14 col-md-8']]
			 )->textInput(['maxlength' => 18]) ?>
						</div>
      </div>
			<div class="row">
     	      <div class="col-sm-8">
    <?= $form->field($model, 'Name'
//	 		,['labelOptions' => ['class' => 'col-sm-2'], 'inputOptions' => ['class' => 'col-sm-10 col-md-10']]
			 )->textInput(['maxlength' => 29]) ?>
						</div>
      </div>

			<div class="row">
     	      <div class="col-sm-8">
    <?= $form->field($model, 'Strasse'
//	 		,['labelOptions' => ['class' => 'col-sm-2'], 'inputOptions' => ['class' => 'col-sm-10 col-md-10']]
			 )->textInput(['maxlength' => 35]) ?>
						</div>
      </div>
    
			<div class="row">
	      <div class="col-sm-8">
	    <?= $form->field($model, 'PLZ'
//	 		,['labelOptions' => ['class' => 'col-sm-4']]
			)->textInput(['maxlength' => 13]) ?>
				</div> 
      </div>
			<div class="row">
	      <div class="col-sm-8">
	    <?= $form->field($model, 'Wohnort'
//	 		,['labelOptions' => ['class' => 'col-sm-3'], 'inputOptions' => ['class' => 'col-sm-10 col-md-10']]
			)->textInput(['maxlength' => 25])	?>
				</div>
			</div> <!-- row -->
			<div class="row">
     	      <div class="col-sm-8">
    <?= $form->field($model, 'Nationalitaet'
//	 		,['labelOptions' => ['class' => 'col-sm-2'], 'inputOptions' => ['class' => 'col-sm-10 col-md-10']]
			)->textInput(['maxlength' => 22]) ?>
						</div>
			</div> <!-- row -->

			<div class="row">
     	      <div class="col-sm-8">
    <?= $form->field($model, 'Beruf'
//	 		,['labelOptions' => ['class' => 'col-sm-2'], 'inputOptions' => ['class' => 'col-sm-10 col-md-10']]
			)->textInput(['maxlength' => 35]) ?>
						</div>
			</div> <!-- row -->
    </div><!-- content -->
  </div> <!-- col -->

	<div class="col-sm-6">

      <div id="content" >
			<div class="row">

     <?= //$form->field($model, 'Schulort')->dropdownList(ArrayHelper::map( schulen::find()->orderBy('SchulId')->all(), 
				//'SchulId', 'Schulname', 'Disziplin.DispName' ),
				//[ 'prompt' => 'Schulort',
				//'value' => 'SchulId'] ); 
				$form->field($model, 'Schulort'
	 		,['labelOptions' => ['class' => 'col-sm-3'], 'inputOptions' => ['class' => 'col-sm-10 col-md-10']]
			)->widget(Select2::classname(), [
					'data' => array_merge(["" => ""], ArrayHelper::map( schulen::find()->distinct()->orderBy('SchulId')->all(), 
				'Schulname', 'Schulname' )),
					'options' => ['placeholder' => 'Schulort auswählen ...'],
					'pluginOptions' => ['allowClear' => true ], ]);   
		?>
			</div> <!-- row -->

			<div class="row">
		<?= $form->field($model, 'Funktion'
	 		,['labelOptions' => ['class' => 'col-sm-3'], 'inputOptions' => ['class' => 'col-sm-10 col-md-10']]
			)->dropdownList(ArrayHelper::map( Funktion::find()->orderBy('funkId')->all(), 'inhalt', 'inhalt' ),
		[ 'prompt' => 'Funktion',
			'value' => 'Funktion', ]
		) ?>
			</div> <!-- row -->

			<div class="row">
		<?= $form->field($model, 'Sifu'
	 		,['labelOptions' => ['class' => 'col-sm-3'], 'inputOptions' => ['class' => 'col-sm-10 col-md-10']]
			)->dropdownList(ArrayHelper::map( Sifu::find()->orderBy('sId')->all(), 'SifuName', 'SifuName' ),
		[ 'prompt' => 'Sifu',
			'value' => 'SifuName', ]
		) ?>
			</div> <!-- row -->

			<div class="row">
   <?= $form->field($model, 'Telefon1'
	 		,['labelOptions' => ['class' => 'col-sm-3'], 'inputOptions' => ['class' => 'col-sm-10 col-md-10']]
			)->textInput(['maxlength' => 18]) ?>
			</div> <!-- row -->

			<div class="row">
    <?= $form->field($model, 'HandyNr'
	 		,['labelOptions' => ['class' => 'col-sm-3'], 'inputOptions' => ['class' => 'col-sm-10 col-md-10']]
			)->textInput(['maxlength' => 18]) ?>
			</div> <!-- row -->

			<div class="row">
    <?= $form->field($model, 'Email'
	 		,['labelOptions' => ['class' => 'col-sm-3'], 'inputOptions' => ['class' => 'col-sm-10 col-md-10']]
			)->textInput(['maxlength' => 42]) ?>
			</div> <!-- row -->

			<div class="row">
    <?= $form->field($model, 'BeitrittDatum'
	 		,['labelOptions' => ['class' => 'col-sm-3'], 'inputOptions' => ['class' => 'col-sm-10 col-md-10']]
			)->widget(DateControl::classname(), [
							'type'=>DateControl::FORMAT_DATE,
							'value' => 'BeitrittDatum',
							'ajaxConversion'=>false,
 							'displayFormat' => 'php:d.m.Y',
 							'saveFormat' => 'php:Y-m-d',
							'options' => [ //'placeholder' => 'Graduierungsdatum ...'],
								'pluginOptions' => [	
										'autoclose'=>true
								] 
							]
						]) 
		?>
			</div> <!-- row -->

			<div class="row">
 		 <?= $form->field($model, 'AktivPassiv'
	 		,['labelOptions' => ['class' => 'col-sm-3'], 'inputOptions' => ['class' => 'col-sm-10 col-md-10']]
			)->widget(Select2::classname(), [
			'data' => array_merge(["" => ""], ['Aktiv','Passiv']),
//			'options' => ['placeholder' => 'Geschlecht auswählen ...'],
			'pluginOptions' => ['allowClear' => true ], ]);   ?>
			</div> <!-- row -->

     	      <div class="col-sm-6">
    <?= $form->field($model, 'PruefungZum')->dropdownList(ArrayHelper::map( Grade::find()->all(), 'gradId', 'GradName', 'DispName' ),
[ 'prompt' => 'Grad' ]
) ?>
						</div>
    </div><!-- content -->
	</div> <!-- col -->
</div> <!-- row -->



