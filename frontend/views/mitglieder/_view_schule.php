<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Modal;
//use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;
use kartik\popover\PopoverX;
use kartik\datecontrol\DateControl;
use kartik\widgets\DatePicker;
use kartik\detail\DetailView;

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
 
    <?= DetailView::widget([
        'model' => $model,
				'condensed'=>true,
				'hover'=>true,
				'mode'=>DetailView::MODE_VIEW,
				'buttons1' => '{update}',
				'panel'=>[
<<<<<<< HEAD
					'heading'=>$model->Name . ', ' . $model->Vorname,
=======
					'heading'=>'Mitglied: ' . $model->Name . ', ' . $model->Vorname,
>>>>>>> refs/remotes/github/master
					'type'=>DetailView::TYPE_INFO,
				],
        'attributes' => [
            'Funktion',
            'Sifu',
//            'LetzteAenderung',
      ],
    ]) ?>




