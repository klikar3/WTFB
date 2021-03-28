<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\IntensivSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="intensiv-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'mitgliederId') ?>

    <?= $form->field($model, 'kontaktNachricht') ?>

    <?= $form->field($model, 'telefonatAm') ?>

    <?= $form->field($model, 'alter') ?>

    <?= $form->field($model, 'graduierung') ?>

    <?php // echo $form->field($model, 'wieLangeWt') ?>

    <?php // echo $form->field($model, 'ausbQuali') ?>

    <?php // echo $form->field($model, 'unterrichtet') ?>

    <?php // echo $form->field($model, 'eigeneSchule') ?>

    <?php // echo $form->field($model, 'eigeneLehrer') ?>

    <?php // echo $form->field($model, 'organisation') ?>

    <?php // echo $form->field($model, 'erfAndereStile') ?>

    <?php // echo $form->field($model, 'ziel') ?>

    <?php // echo $form->field($model, 'wievielZeit') ?>

    <?php // echo $form->field($model, 'trainingsPartner') ?>

    <?php // echo $form->field($model, 'erstTermin') ?>

    <?php // echo $form->field($model, 'bemerkung') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
