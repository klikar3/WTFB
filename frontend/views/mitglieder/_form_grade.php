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
     </div><!-- content -->
  </div> <!-- col -->
	<div class="col-sm-6">
     <div id="content" >
     </div><!-- content -->
  </div> <!-- col -->
</div> <!-- row -->


