<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pruefer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pruefer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prueferId')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'pName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'sort')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
