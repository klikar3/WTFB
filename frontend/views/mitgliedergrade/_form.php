<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
//use yii\widgets\ActiveForm;
use frontend\models\Mitglieder;
use frontend\models\Disziplinen;
use frontend\models\DisziplinenSearch;
use frontend\models\Grade;
use frontend\models\GradeSearch;
use frontend\models\Pruefer;
use yii\bootstrap\Modal;
use kartik\widgets\ActiveForm;
//use kartik\widgets\DatePicker;
use kartik\datecontrol\DateControl;


/* @var $this yii\web\View */
/* @var $model frontend\models\Mitgliedergrade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mitgliedergrade-form">
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'MitgliedId')->hiddenInput()->label('') ?>

    <?= $form->field($model, 'GradId')->dropdownList(ArrayHelper::map( Grade::find()->all(), 'gradId', 'GradName', 'DispName' ),
[ 'prompt' => '',
	'value' => 'GradId']
)->label('Graduierung') ?>

    <?= $form->field($model, 'Datum')->widget(DateControl::classname(), [
							'type'=>DateControl::FORMAT_DATE,
							'ajaxConversion'=>true,
 							'displayFormat' => 'php:d.m.Y',
 							'saveFormat' => 'php:Y-m-d',
							'value' => 'Datum',
//							'options' => ['placeholder' => 'Graduierungsdatum ...'],
							'pluginOptions' => [	
									'autoclose'=>true
							] 
						]) 
		?>

    <?= $form->field($model, 'PrueferId')->dropdownList(ArrayHelper::map( Pruefer::find()->all(), 'prueferId', 'pName' ),
[ 'prompt' => '' ]
)->label('Prüfer') ?>

	<?= $form->field($model, 'print')->checkBox(
	[ 'prompt' => 'Print' ]
	) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Zuweisen') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
