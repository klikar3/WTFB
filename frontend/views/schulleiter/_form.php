<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Schulleiter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schulleiter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'LeiterId')->textInput() ?>

    <?= $form->field($model, 'LeiterName')->textInput(['maxlength' => 80]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
