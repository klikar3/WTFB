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
    <?= $form->field($model, 'BLZ')->textInput(['maxlength' => 9]) 
		?>

    <?= $form->field($model, 'Bank')->textInput(['maxlength' => 45]) 
		?>

    <?= $form->field($model, 'KontoNr')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'Status')->textInput(['maxlength' => 17]) 
		?>

    <?= $form->field($model, 'AktivPassiv')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'Kontoinhaber')->textInput(['maxlength' => 31]) 
		?>

     </div><!-- content -->
  </div> <!-- col -->
	<div class="col-sm-6">
     <div id="content" >
    <?= $form->field($model, 'VDauer')->textInput(['maxlength' => 13]) 
		?>

    <?= $form->field($model, 'Monatsbeitrag')->textInput(['maxlength' => 10]) 
		?>

    <?= $form->field($model, 'BeitrittDatum')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'KuendigungDatum')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'AustrittDatum')->textInput(['maxlength' => 19]) 
		?>

    <?= $form->field($model, 'Geburtsort')->textInput(['maxlength' => 26]) 
		?>

    <?= $form->field($model, 'GruppenArt')->textInput(['maxlength' => 18]) 
		?>

    <?= $form->field($model, 'Zahlungsart')->textInput(['maxlength' => 12]) 
		?>

    <?= $form->field($model, 'Zahlungsweise')->textInput(['maxlength' => 16]) 
		?>

    <?= $form->field($model, 'EinzugZum')->textInput(['maxlength' => 15]) 
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



