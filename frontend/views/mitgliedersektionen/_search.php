<?php

use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MitgliedersektionenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mitgliedersektionen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'msekt_id') ?>

    <?= $form->field($model, 'mitglied_id') ?>

    <?= $form->field($model, 'sektion_id') ?>

    <?= $form->field($model, 'vdatum') ?>

    <?= $form->field($model, 'vermittler_id') ?>

    <?= $form->field($model, 'pdatum') ?>

    <?= $form->field($model, 'pruefer_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
