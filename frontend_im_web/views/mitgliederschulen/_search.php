<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MitgliederschulenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mitgliederschulen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'msID') ?>

    <?= $form->field($model, 'MitgliederId') ?>

    <?= $form->field($model, 'SchulId') ?>

    <?= $form->field($model, 'Von') ?>

    <?= $form->field($model, 'Bis') ?>

    <?php // echo $form->field($model, 'VertragId') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
