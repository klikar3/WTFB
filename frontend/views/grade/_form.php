<?php

use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\widgets\ActiveForm;

use frontend\models\Disziplinen;


/* @var $this yii\web\View */
/* @var $model frontend\models\Grade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="grade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'GradName')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'DispName')// ->textInput(['maxlength' => 30]) 
    				->dropdownList(ArrayHelper::map( Disziplinen::find()->all(), 'DispName', 'DispName' )
																			 									,['style'=>'']
			);
    ?>
    <?= $form->field($model, 'sort')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'gKurz')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'Gebuehr')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'textcode')->textInput(['maxlength' => 50]) ?>
 
    <?= $form->field($model, 'print')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
