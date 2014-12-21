<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Schulen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schulen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Schulname')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'Disziplin')->textInput(['maxlength' => 30]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
