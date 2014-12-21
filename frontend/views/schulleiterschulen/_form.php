<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use frontend\models\Schulleiter;
use frontend\models\Schulen;
use frontend\models\Disziplinen;

/* @var $this yii\web\View */
/* @var $model frontend\models\Schulleiterschulen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schulleiterschulen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'LeiterId')->dropdownList(ArrayHelper::map( Schulleiter::find()->all(), 'LeiterId', 'LeiterName' ),
											[ 'prompt' => 'Schulleiter' ]
				) ?>
				
    <?= $form->field($model, 'SchulId')->dropdownList(ArrayHelper::map( Schulen::find()->all(), 'SchulId', 'Schulname' ),
											[ 'prompt' => 'Schule' ]
				) ?>
				
    <?= $form->field($model, 'DispId')->dropdownList(ArrayHelper::map( Disziplinen::find()->all(), 'DispId', 'DispName' ),
											[ 'prompt' => 'Disziplin' ]
				) ?>
				
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
