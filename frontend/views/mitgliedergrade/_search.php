<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MitgliedergradeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mitgliedergrade-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'mgID') ?>

    <?= $form->field($model, 'MitgliedId') ?>

    <?= $form->field($model, 'GradId') ?>

    <?= $form->field($model, 'Datum') ?>

    <?= $form->field($model, 'PrueferId') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
