<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliederdisziplinen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mitgliederdisziplinen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'MitgliedId')->textInput() ?>

    <?= $form->field($model, 'DisziplinId')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'Von')->textInput() ?>

    <?= $form->field($model, 'Bis')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
