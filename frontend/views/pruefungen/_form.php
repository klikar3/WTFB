<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\datecontrol\DateControl;

use frontend\models\Pruefer;
use frontend\models\Disziplinen;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pruefungen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pruefungen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dispId')->dropdownList(ArrayHelper::map( Disziplinen::find()->all(), 'DispId', 'DispName')) ?>

    <?= $form->field($model, 'datum')->widget(DateControl::classname(),
		[ //'value' => date('d.m.Y'), 
			'type'=>DateControl::FORMAT_DATE,
			'ajaxConversion'=>true,
			'displayFormat' => 'php:d.m.Y',
			'saveFormat' => 'php:Y-m-d',
			'autoWidget' => true,
			'id' => 'pr_vdatu',
			'options'=>[
				'id' => 'pr_vdatum',
					'pluginOptions'=>['autoclose'=>true, 'todayHighlight' => true, 'todayBtn' => true]
				]	
			]); ?>

    <?= $form->field($model, 'prueferId')->dropdownList(ArrayHelper::map( Pruefer::find()->all(), 'prueferId', 'pName')) ?>

    <?= $form->field($model, 'erledigt')->checkBox(
	[ 'prompt' => 'Erledigt' ]
	) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
