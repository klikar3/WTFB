<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use frontend\models\Sifu;
use frontend\models\Schulleiter;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pruefer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pruefer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prueferId')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'pName')->dropdownList(array_merge(ArrayHelper::map( Sifu::find()->all(), 'SifuName', 'SifuName' )
                                                                ,ArrayHelper::map( Schulleiter::find()->all(), 'LeiterName', 'LeiterName' )),
													[ 'prompt' => 'Pruefer', 'id' => 'field-pid' ])->label(Yii::t('app', 'Pruefer')); ?>

    <?= $form->field($model, 'sort')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'recDeleted')->checkBox(
                      [ 'prompt' => 'Deleted' ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
