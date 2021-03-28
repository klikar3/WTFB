<?php

use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
//use yii\helpers\Html;
//use yii\widgets\ActiveForm;

use kartik\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use kartik\widgets\DatePicker;

use frontend\models\Trainings;
/* @var $this yii\web\View */
/* @var $model frontend\models\Anwesenheit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anwesenheit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'trainingsId')->textInput() ?>
    <?= $form->field($model, 'trainingsId',['labelOptions'=>['style'=>'font-size:0.85em;height:1em;'],
																	 'inputOptions' => ['style'=>'font-size:0.85em;']
																	 ])->dropdownList(array_merge(["" => ""], ArrayHelper::map( Trainings::find()->all(), 'id', 'description','schul.SchulDisp' )),['style'=>''])->label('Training');
		?>

    <?php // $form->field($model, 'datum')->textInput() ?>
		<?php  echo $form->field($model, 'datum')->widget(DateControl::classname(),
		[ //'value' => date('d.m.Y'), 
			'type'=>DateControl::FORMAT_DATE,
			'ajaxConversion'=>true,
			'displayFormat' => 'php:d.m.Y',
			'saveFormat' => 'php:Y-m-d',
			'autoWidget' => true,
			'id' => 'mgf_datu',
			'options'=>[
				'id' => 'mgf_datum',
//										'placeholder'=>'Graduierungsdatum', 
					'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true]
				]	
			]); ?>

    <?= $form->field($model, 'anzahl')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
