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

use frontend\models\Mitgliedergrade;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Pruefer;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

?>

<div class="row">
	<div class="col-sm-6">
     <div id="content" >
    <?= $form->field($model, 'Monatsbeitrag')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'Zahlungsart')->widget(Select2::classname(), [
			'data' => array_merge(["" => ""], ['Bankeinzug'=>'Bankeinzug','Bar'=>'Bar','Überweisung'=>'Überweisung']),
			'options' => ['placeholder' => 'Zahlungsart auswählen ...'],
			'pluginOptions' => ['allowClear' => true ], ]);  
		?>

    <?= $form->field($model, 'Zahlungsweise')->widget(Select2::classname(), [
			'data' => array_merge(["" => ""], ['monatlich'=>'monatlich','vierteljährlich'=>'vierteljährlich','halbjährlich'=>'halbjährlich','jährlich'=>'jährlich']),
			'options' => ['placeholder' => 'Zahlungsweise auswählen ...'],
			'pluginOptions' => ['allowClear' => true ], ]);  
		?>

    <?= $form->field($model, 'VDauer')->widget(Select2::classname(), [
			'data' => array_merge(["" => ""], ['6 Monate'=>'6 Monate','12 Monate'=>'12 Monate']),
			'options' => ['placeholder' => 'Vertragsdauer auswählen ...'],
			'pluginOptions' => ['allowClear' => true ], ]);   
		?>

    <?= $form->field($model, 'EinzugZum')->widget(Select2::classname(), [
			'data' => array_merge(["" => ""], ['1. d. M.'=>'1. d. M.','15. d. M.'=>'15. d. M.']),
			'options' => ['placeholder' => 'Einzug zum ...'],
			'pluginOptions' => ['allowClear' => true ], ]); 
		?>

    <?= $form->field($model, 'IBAN')->textInput(['maxlength' => 25]) 
		?>

    <?= $form->field($model, 'BLZ')->textInput(['maxlength' => 9]) 
		?>

    <?= $form->field($model, 'Bank')->textInput(['maxlength' => 45]) 
		?>

    <?= $form->field($model, 'KontoNr')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'Kontoinhaber')->textInput(['maxlength' => 31]) 
		?>

     </div><!-- content -->
  </div> <!-- col -->
	<div class="col-sm-6">
     <div id="content" >
    <?= $form->field($model, 'Status')->textInput(['maxlength' => 17]) 
		?>

    <?= $form->field($model, 'KuendigungDatum')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'AustrittDatum')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'GruppenArt')->textInput(['maxlength' => 18]) 
		?>

    <?= $form->field($model, 'BeitragAussetztenVon')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'BeitragAussetzenBis')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'BeitragAussetzenGrund')->textInput(['maxlength' => 37]) 
		?>

    <?= $form->field($model, 'AufnahmegebuehrBezahlt')->textInput(['maxlength' => 14]) 
		?>
     </div><!-- content -->
  </div> <!-- col -->
</div> <!-- row -->



