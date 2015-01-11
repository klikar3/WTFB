<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliederschulen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mitgliederschulen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'MitgliederId')->textInput() ?>

    <?= $form->field($model, 'SchulId')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'Von')->textInput() ?>

    <?= $form->field($model, 'Bis')->textInput() ?>

    <?= $form->field($model, 'VertragId')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
