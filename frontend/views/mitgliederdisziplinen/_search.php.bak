<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MitgliederdisziplinenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mitgliederdisziplinen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'maId') ?>

    <?= $form->field($model, 'MitgliedId') ?>

    <?= $form->field($model, 'DisziplinId') ?>

    <?= $form->field($model, 'Von') ?>

    <?= $form->field($model, 'Bis') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
