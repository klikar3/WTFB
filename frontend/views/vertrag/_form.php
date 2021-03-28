<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vertrag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vertrag-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pdf')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
