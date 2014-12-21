<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Disziplinen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="disziplinen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DispName')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'DispKurz')->textInput(['maxlength' => 5]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
