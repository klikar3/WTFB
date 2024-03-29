<?php

use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\widgets\ActiveForm;

use frontend\models\Schulen;

/* @var $this yii\web\View */
/* @var $model frontend\models\Trainings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trainings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'schulId')->textInput() ?>
    <?= $form->field($model, 'schulId',['labelOptions'=>['style'=>'font-size:0.85em;height:1em;'],
																	 'inputOptions' => ['style'=>'font-size:0.85em;']
																	 ])->dropdownList(array_merge(["" => ""], ArrayHelper::map( Schulen::find()->all(), 'SchulId', 'SchulDisp', 'disziplinen.DispName' )),['style'=>'']);
		?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
