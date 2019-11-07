<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Intensiv */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="intensiv-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mitgliederId')->textInput() ?>

    <?= $form->field($model, 'kontaktNachricht')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'telefonatAm')->textInput() ?>

    <?= $form->field($model, 'alter')->textInput() ?>

    <?= $form->field($model, 'graduierung')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wieLangeWt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ausbQuali')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unterrichtet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eigeneSchule')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eigeneLehrer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'organisation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'erfAndereStile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ziel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wievielZeit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trainingsPartner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'erstTermin')->textInput() ?>

    <?= $form->field($model, 'bemerkung')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
