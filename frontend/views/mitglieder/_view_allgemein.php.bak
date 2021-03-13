<?php

use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;
//use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\datecontrol\datecontrol;
use kartik\widgets\DatePicker;
use kartik\detail\DetailView;
use kartik\popover\PopoverX;

use frontend\models\Anrede;
use frontend\models\Funktion;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\InteressentVorgaben;
use frontend\models\Mitglieder;
use frontend\models\Mitgliedergrade;
use frontend\models\Pruefer;
use frontend\models\Schulen;
use frontend\models\Sifu;
 
/* @var $this yii\web\View */
/* @var $model app\models\Mitglieder */

$newnr = Mitglieder::find()->max('MitgliedsNr') + 1;
?>
<div class="row">
<?php if ($model->Schulort == 'WT-Intensiv') {
        echo $this->render('_v_a_person_intensiv', [ 'model' => $model, 'newnr' => $newnr]);
        echo $this->render('_v_a_kontakt_intensiv', [ 'intensiv' => $model->mitgliederIntensiv, 'newnr' => $newnr]);
      } else {
        echo $this->render('_v_a_person_normal', [ 'model' => $model, 'newnr' => $newnr]);
        echo $this->render('_v_a_kontakt_normal', [ 'model' => $model, 'newnr' => $newnr]);
      }
?>
</div>

