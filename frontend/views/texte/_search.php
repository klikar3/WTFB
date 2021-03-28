<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TexteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="texte-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'SchulId') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'fuer') ?>

    <?= $form->field($model, 'txt') ?>

    <?php // echo $form->field($model, 'betreff') ?>

    <?php // echo $form->field($model, 'quer') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
